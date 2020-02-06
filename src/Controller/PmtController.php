<?php
// src/Controller/WildController.php


namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\LevelRepository;
use App\Repository\OfficeRepository;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("bureau", name="_showTeam")
     * @param LevelRepository $levelRepository
     * @param OfficeRepository $officeRepository
     * @return Response
     */
    public function showTeam(LevelRepository $levelRepository, OfficeRepository $officeRepository): Response
    {

        $level = $levelRepository->findLevelsWithUsers();


        return $this->render('tmp/team.html.twig', [
            'levels' => $levelRepository->findLevelsWithUsers(),
            'offices' => $officeRepository->findMembersOffice()
        ]);
    }

    /**
     * @Route("portfolio", name="_portfolio")
     * @param PictureRepository $pictureRepository
     * @return Response
     * @throws Exception
     */
    public function portfolio(PictureRepository $pictureRepository): Response
    {
        // on recupere toute les photos
        $pictures = $pictureRepository->findAll();

        return $this->render(
            'tmp/portfolio.html.twig',
            ['pictures' => $pictures]
        );
    }

    /**
     * @Route("plouf", name="_madamemongoingoingoin")
     * @return Response
     * @throws Exception
     */
    public function plouf(): Response
    {
        // on recupere toute les photos

        return $this->render(
            'tmp/activisme.html.twig',
        );
    }
}
