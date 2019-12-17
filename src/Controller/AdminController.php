<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function admin()
    {
        return $this->render('admin/index.html.twig', [

        ]);
    }

    /**
     * @Route("/document", name="document")
     * @param Request $request
     * @return Response
     */
    public function loadDocument(Request $request) :Response
    {
        $document= new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form['name']->getData();
            $fileName = $this->generateUniqueFileName() . '.' . $brochureFile->guessExtension();
            $destination = $this->getParameter('brochure_directory');
            $brochureFile->move(
                $destination,
                $fileName
            );

            $document->setName($fileName);
            $document->setPath($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($document);
            $entityManager->flush();
            return $this->redirectToRoute('admin_document');
        }
        return $this->render('document/index.html.twig', [
            'form' => $form->createView(),
            'documents'=>$document
        ]);
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
