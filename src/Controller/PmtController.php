<?php
// src/Controller/WildController.php


namespace App\Controller;

use App\Repository\LevelRepository;
use App\Repository\OfficeRepository;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @param LevelRepository $levelRepository
     * @param OfficeRepository $officeRepository
     * @return Response
     */
    public function showTeam(LevelRepository $levelRepository, OfficeRepository $officeRepository): Response
    {

        return $this->render('tmp/team.html.twig', [
            'levels' => $levelRepository->findLevelsWithUsers(),
            'offices' => $officeRepository->findMembersOffice()
        ]);
    }

    /**
     * @Route("portfolio", name="_portfolio")
     * @param PictureRepository $pictureRepository
     * @return Response
     */
    public function portfolio(PictureRepository $pictureRepository): Response
    {
        $pictures= $pictureRepository->findAll();
        return $this->render('tmp/portfolio.html.twig', ['pictures'=>$pictures]);
    }
}
