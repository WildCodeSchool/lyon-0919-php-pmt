<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Entity\Level;
use App\Form\InscriptionClubType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

            $user->setLevel($data['level']);
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
}
