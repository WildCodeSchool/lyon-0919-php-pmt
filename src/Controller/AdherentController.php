<?php


namespace App\Controller;

use App\Entity\InscriptionStatus;
use App\Entity\Participant;
use App\Entity\Trip;
use App\Form\ParticipantType;
use App\Form\ParticipantCancelType;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdherentController extends AbstractController
{
    /**
     * @Route("/account", name="account_index", methods={"GET" , "POST"})
     * @param Request $request
     * @return Response
     */
    public function show(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $userLogin = $this->getUser();

//        Gestion du form de mise à jour des infos de l'adherent
        $form = $this->createForm(UserType::class, $userLogin);
        $form->handleRequest($request);

        $participant = new Participant();
        //gestion du form de participation à une sortie
        $formTripRegistration = $this->createForm(ParticipantType::class, $participant);
        $formTripRegistration->handleRequest($request);

        $participantToDelete = new Participant();
        $formTripCancellation = $this->createForm(ParticipantCancelType::class, $participantToDelete);
        $formTripCancellation->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userLogin);
            $entityManager->flush();
        }

//        si on soumets l'inscription à un trip
        if ($formTripRegistration->isSubmitted() && $formTripRegistration->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
//            TODO : changer le status si en attente ou inscription direct
//            TODO: ne pas inscrire  2 fois la meme personne
            $participant->setStatus('inscription non validée');
            $participant->setUser($userLogin);
            $entityManager->persist($participant);
            $entityManager->flush();
        }

//        si on efface l'inscription à un trip
        if ($formTripCancellation->isSubmitted() && $formTripCancellation->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $tupleToDelete = $this->getDoctrine()
                ->getRepository(Participant::class)
                ->findOneBy(['user' => $userLogin, 'trip' => $participantToDelete->getTrip()]);
            if ($tupleToDelete != null) {
                $entityManager->remove($tupleToDelete);
                $entityManager->flush();
            }
        }

//        liste des sorties ou le user est inscrits
        $alreadyBookedTrip = $this->getDoctrine()
            ->getRepository(Participant::class)
            ->findBy(['user' => $userLogin]);


        //on recupere la liste des sorties
        $trips = $this->getDoctrine()
            ->getRepository(Trip::class)
            ->findAll();

//        listes des sorties non bookés
        $notBookedTrip = [];
        foreach ($trips as $trip) {
            $exist = 0;
            foreach ($alreadyBookedTrip as $bookTrip) {
                if ($trip->getId() === $bookTrip->getTrip()->getId()) {
                    $exist = 1;
                    break;
                } else {
                    $exist = 0;
                }
            }
            if ($exist === 0) {
                $notBookedTrip[] = $trip;
            }
        }

        return $this->render('user/show.html.twig', [
            'user' => $userLogin,
            'form' => $form,
            'formTripRegistration' => $formTripRegistration,
            'formTripCancellation' => $formTripCancellation,
//            'trips' => $trips,
            'tripsAlreadyBook' => $alreadyBookedTrip,
            'tripsNotBooked' => $notBookedTrip
        ]);
    }
}
