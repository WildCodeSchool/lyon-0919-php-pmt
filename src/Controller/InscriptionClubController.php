<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Inscription;
use App\Entity\Level;
use App\Form\InscriptionClubType;
use App\Entity\User;
use App\Repository\DocumentRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PDF;

/**
 * @Route("/adherent")
 */
class InscriptionClubController extends AbstractController
{
    /**
     * @Route("/inscriptionForm", name="inscriptionForm")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['isAdmin' => null]);

        $inscriptionForm = $this->createForm(InscriptionClubType::class, null, ['user' => $user]);
        $inscriptionForm->handleRequest($request);

        if ($inscriptionForm->isSubmitted() && $inscriptionForm->isValid()) {
            $data = $inscriptionForm->getData();

            $inscription = $data['inscription'];
            $insurance = $data['insurance'];
            $adhesion = $data['adhesion'];
            $inscription->setUser($user);
            $inscription->setInsurance($insurance);
            $inscription->setAdhesionPrice($adhesion);

            if ($user != null) {
                $user->setLevel($data['level']);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data['user']);
            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('inscriptionForm');
        }

        return $this->render('inscription_club/index.html.twig', [
            'inscriptionForm' => $inscriptionForm->createView(),
        ]);
    }

    /**
     * @Route("/pdf", name="pdf")
     * @return void
     */
    public function pdfAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $userLogin = $this->getUser();

        $documents = $this->getDoctrine()
            ->getRepository(Document::class)
            ->findAll();

//        dd($userLogin);

        $template = $this->renderView('inscription_club/pdf.html.twig', [
            'userLogin' => $userLogin,
            'documents' => $documents,
        ]);

        $html2pdf = new PDF();
        $html2pdf->create('P', 'A4', 'fr', true, 'UTF-8', array(10, 15, 10, 15));

        return $html2pdf->generatePdf($template);
    }
}
