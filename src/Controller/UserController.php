<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    protected $auth;
    public function __construct(AuthorizationCheckerInterface $auth)
    {
        $this->auth = $auth;
    }


    /**
     * @Route("/", name="user_index", methods={"GET"})
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        //TODO Attention le form n'est pas valide lors de la submitation: && $form->isValid()
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['ImageFile']->getData();
            if ($file) {
                $fileName = 'Image' .$user->getId() . '.' . $file->guessExtension();
//                 moves the file to the directory where brochures are stored
                $destination = $this->getParameter('image_user_upload');
                $file->move(
                    $destination,
                    $fileName
                );

                // updates the 'brochure' property to store the PDF file name
                // instead of its contents
                $user->setImageName($fileName);
            }
            // ... persist the $product variable or any other work
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Votre profil a été mis à jour!');
//            return $this->redirect($this->generateUrl('app_product_list'));

            if ($this->auth->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('account_index');
            }
            if ($this->auth->isGranted('ROLE_SUBSCRIBER')) {
                return $this->redirectToRoute('account_index');
            }
        }
        return $this->render('user/edit.html.twig', ['user' => $user,
            'form' => $form->createView(),]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }
        return $this->redirectToRoute('user_index');
    }
}
