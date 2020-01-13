<?php
// src/Controller/WildController.php


namespace App\Controller;

use App\Repository\LevelRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
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
     * @param LevelRepository $levelRepository
     * @return Response
     */
    public function showTeam(UserRepository $userRepository, LevelRepository $levelRepository): Response
    {

        return $this->render('tmp/team.html.twig', [
            'userAdmins' => $userRepository->findBy(['isAdmin' => true]),
            'levels' => $levelRepository->findLevelsWithUsers()

        ]);
    }
}
