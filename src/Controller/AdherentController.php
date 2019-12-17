<?php


namespace App\Controller;

use App\Entity\Trip;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdherentController extends AbstractController
{
    /**
     * @Route("/account", name="account_index", methods={"GET" , "POST"})
     */
    public function show(Request $request): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $userLogin = $this->getUser();

        //on recupere la liste des sorties
        $trips = $this->getDoctrine()
            ->getRepository(Trip::class)
            ->findAll();

//        Gestion du form de mise à jour des infos de l'adherent
        $form = $this->createForm(UserType::class, $userLogin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userLogin);
            $entityManager->flush();
        }

        return $this->render('user/show.html.twig', [
            'user' => $userLogin,
            'form' => $form,
            'trips' => $trips
        ]);
    }
}
