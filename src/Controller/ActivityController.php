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
     *
     * @Route("", name="index")
     * @return Response
     */
    public function index(): Response
    {
        $pictures = $this->getDoctrine()
            ->getRepository(Picture::class)
            ->findAll();


        return $this->render('tmp/activity.html.twig', [
            'pictures' => $pictures
        ]);
    }
}
