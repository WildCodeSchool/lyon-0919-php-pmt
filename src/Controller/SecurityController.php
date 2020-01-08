<?php

namespace App\Controller;

use App\Entity\User;

use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @param AuthenticationUtils $utils
     * @param UserInterface|null $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request, AuthenticationUtils $utils, ?UserInterface $user)
    {
//        TODO virer les 2 $prout
        $prout = $request;
        $prout = $user;
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
            'prout' => $prout,
        ]);
    }

    /**
     * @Route("/logout", name= "security_logout")
     */
    public function logout()
    {
    }

    /**
     * @Route("/forgottenPassword", name="forgotten_password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param \Swift_Mailer $mailer
     * @param TokenGeneratorInterface $tokenGenerator
     * @return Response
     */
    public function forgottenPassword(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        \Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ): Response {
        $encoder;
//        TODO enlever ce $encoder tout moche
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('pmtindex');
            }
            $token = $tokenGenerator->generateToken();

            try {
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('pmtindex');
            }

            $url = $this->generateUrl('reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new Swift_Message('Mot de passe oublié'))
                ->setFrom('pmt@gmail.com')
                ->setTo($user->getEmail())
                ->setBody($this->renderView(
                    'emails/password.html.twig',
                    ['url' => $url]
                ), 'text/html');

            $mailer->send($message);

            $this->addFlash('success', 'Mail envoyé');

//            return $this->redirectToRoute('pmtindex');
        }
        return $this->render('security/forgotten_password.html.twig');
    }

    /**
     * @Route("/reset_password/{token}", name="reset_password")
     * @param Request $request
     * @param string $token
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {

        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('pmtindex');
            }

            if ($request->request->get('password') === $request->request->get('password2')) {
                $user->setResetToken(null);
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
                $entityManager->flush();

                return $this->redirectToRoute('pmtindex');
            } else {
                $this->addFlash(
                    'danger',
                    'Les mots de passe ne sont identiques !'
                );
            }
        }
        return $this->render('security/reset_password.html.twig', ['token' => $token]);
    }
}
