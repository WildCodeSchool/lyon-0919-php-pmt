<?php
// src/Controller/WildController.php


namespace App\Controller;

use App\Repository\LevelRepository;
use App\Repository\UserRepository;
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
     * @param UserRepository $userRepository
     * @return Response
     */
    public function showTeam(UserRepository $userRepository): Response
    {
        $levels = $this->getDoctrine()
            ->getRepository(Level::class)
            ->findAll();

        return $this-> render('tmp/team.html.twig', [
            'levels' => $levels,
            'userAdmins' => $userRepository->findBy(['isAdmin' => true])
        ]);
    }
}
