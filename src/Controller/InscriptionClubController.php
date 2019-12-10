<?php

namespace App\Controller;

use App\Form\InscriptionClubType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionClubController extends AbstractController
{
    /**
     * @Route("/inscriptionForm", name="inscriptionForm")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $inscriptionForm = $this->createForm(InscriptionClubType::class);
        $inscriptionForm->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
//            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
//
//            return $this->redirectToRoute('task_success');
//        }

        return $this->render('inscription_club/index.html.twig', [
            'inscriptionForm' => $inscriptionForm->createView(),
        ]);
    }
}
