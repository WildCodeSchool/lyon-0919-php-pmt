<?php
// src/Controller/WildController.php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/pmt", name="pmt")
 */
class PmtController extends AbstractController
{

    /**
     * show all rows for Program's entity
     *
     * @Route("", name="index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('tmp/index.html.twig');
    }
}
