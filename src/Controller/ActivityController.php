<?php
// src/Controller/WildController.php


namespace App\Controller;

use App\Entity\Picture;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/activity", name="activity_")
 */
class ActivityController extends AbstractController
{

    /**
     * show all rows for Program's entity
     *
     * @Route("", name="index")
     * @param UserRepository $user
     * @return Response
     */
    public function index(UserRepository $user): Response
    {
        return $this->render('tmp/activity.html.twig', ['users' => $user]);
    }

    /**
     *
     * @Route("/slide", name="activity_")
     * @return Response
     */
    public function slidePicture(): Response
    {
        $pictures = $this->getDoctrine()
            ->getRepository(Picture::class)
            ->findAll();
        return $this->render('tmp/activity.html.twig', [
            'pictures' => $pictures,
        ]);
    }
}
