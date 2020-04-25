<?php


namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use EasyCorp\Bundle\EasyAdminBundle\Twig\EasyAdminTwigExtension;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/adminPMT", name="csv")
 */

class EasyAdminExtendsController extends EasyAdminController
{
    public function exportAction()
    {
        $this->dispatch(EasyAdminEvents::PRE_SEARCH);
        $searchableFields = $this->entity['search']['fields'];
        $paginator = $this->findBy(
            $this->entity['class'],
            $this->request->query->get('query'),
            $searchableFields,
            1,
            10000000000,
            $this->request->query->get('sortField'),
            $this->request->query->get('sortDirection'),
            $this->entity['search']['dql_filter']
        );
        $fields = $this->entity['list']['fields'];
        $this->dispatch(
            EasyAdminEvents::POST_SEARCH,
            array(
                'fields' => $fields,
                'paginator' => $paginator,
            )
        );
        return $this->getExportFile($paginator, $fields);
    }

    public function getExportFile($paginator, $fields)
    {
        $out = fopen('php://temp', 'w+');

        fputcsv($out, array_keys($fields));

        $twig = $this->get('twig');
        $eaTwig = $twig->getExtension(EasyAdminTwigExtension::class);

        foreach ($paginator as $user) {
            $row = [];
            foreach ($fields as $field) {
                $val = strip_tags($eaTwig->renderEntityField($twig, 'list', $this->entity['name'], $user, $field));
                $row[] = trim($val);
            }
            fputcsv($out, $row);
        }

        fseek($out, 0);
        $response = new StreamedResponse(function () use ($out) {
            fpassthru($out);
        });
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            sprintf('export-%s-%s.csv', $this->entity['name'], date('Ymdhis'))
        );

        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}
