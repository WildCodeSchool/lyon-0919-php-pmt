<?php
// src/Controller/WildController.php


namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\LevelRepository;
use App\Repository\OfficeRepository;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManager;
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

        return $this->render('tmp/team.html.twig', [
            'levels' => $levelRepository->findLevelsWithUsers(),
            'offices' => $officeRepository->findMembersOffice()
        ]);
    }

    /**
     * @Route("portfolio", name="_portfolio")
     * @param PictureRepository $pictureRepository
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function portfolio(PictureRepository $pictureRepository, Request $request): Response
    {
        $user = $this->getUser();
        $picture = new Picture();
        //on creer le formulaire pour un ajout de photo et de commentaires
        $form = $this->createForm(PictureType::class, $picture);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('name')->getData();
            $comments = $form->get('comments')->getData();
            if ($imageFile) {
                $fileName = $this->getUser()->getId() . uniqid('_') . '.' . $imageFile->guessExtension();
                $destination = $this->getParameter('product_images');
                $imageFile->move($destination, $fileName);
                $picture->setName($fileName);
                $picture->setComments($comments);
                $picture->setUser($this->getUser());
                $this->getDoctrine()->getManager()->persist($picture);
            }
            $this->getDoctrine()->getManager()->flush();
        }
        // on recupere toute les photos
        $pictures = $pictureRepository->findAll();

        // on recupere les data du user connecté pour pouvoir modifier ou supp ses pictures
        $userData = $pictureRepository->findBy(['user' => $user]);

        return $this->render(
            'tmp/portfolio.html.twig',
            ['pictures' => $pictures,
                'form' => $form->createView(),
                'userData' => $userData]
        );
    }

    /**
     * @Route("/{id}", name="_picture_delete", methods={"DELETE"})
     * @param Request $request
     * @param Picture $picture
     * @return Response
     */
    // La fonction supprime la photo dans le portfolio avec le user en question logué
    public function delete(Request $request, Picture $picture): Response
    {
        if ($this->isCsrfTokenValid('delete' . $picture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($picture);
            $entityManager->flush();
        }
        return $this->redirectToRoute('pmt_portfolio');
    }
}
