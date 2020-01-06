<?php
// src/Controller/WildController.php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Level;

/**
 *
 * @Route("/", name="pmt")
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

     /**
     * @Route("team", name="_showTeam")
     * @return Response
     */
    public function showTeam(): Response
    {
        $userAdmins = $this->getDoctrine()
            ->getRepository(User::class)
            ->findBy(['isAdmin' => true]);

        $userMonitors = $this->getDoctrine()
            ->getRepository(User::class)
            ->findBy(['isMonitor' => true]);



        return $this->render('tmp/team.html.twig', [
            'userAdmins' => $userAdmins,
            'userMonitors' => $userMonitors
        ]);
    }
}
