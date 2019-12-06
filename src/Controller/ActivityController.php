<?php
// src/Controller/WildController.php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/", name="tmp")
 */
class ActivityController extends AbstractController
{

    /**
     * show all rows for Program's entity
     *
     * @Route("", name="tmp")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('tmp/activity.html.twig');
    }
}
