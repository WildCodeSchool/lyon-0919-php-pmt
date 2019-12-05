<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdherentController extends AbstractController
{
    /**
     * @Route("/adherent", name="adherent")
     */
    public function index()
    {
        return $this->render('adherent/index.html.twig', [
            'controller_name' => 'AdherentController',
        ]);
    }
}
