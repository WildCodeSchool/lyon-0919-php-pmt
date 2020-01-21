<?php


namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("album", name="album")
 */
class AlbumController extends AbstractController
{
    /**
     * @Route("/", name="_view")
     * @param PictureRepository $pictureRepository
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function showMyAlbum(PictureRepository $pictureRepository, Request $request)
    {
        $user = $this->getUser();
        // on recupere les data du user connecté pour pouvoir modifier ou supp ses pictures
        $userData = $pictureRepository->findBy(['user' => $user]);
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
        $userData = $pictureRepository->findBy(['user' => $user]);

        return $this->render('tmp/album.html.twig', ['userData' => $userData,  'form' => $form->createView(),]);
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
        return $this->redirectToRoute('album_view');
    }
}
