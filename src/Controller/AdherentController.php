<?php


namespace App\Controller;

use App\Entity\Document;
use App\Entity\Inscription;
use App\Entity\InscriptionStatus;
use App\Entity\Participant;
use App\Entity\Trip;
use App\Entity\User;
use App\Form\InscriptionType;
use App\Form\ParticipantType;
use App\Form\ParticipantCancelType;
use App\Form\UserType;
use App\Repository\ParticipantRepository;
use Symfony\Component\HttpFoundation\File\File;
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
        /** @var User $user */
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

//        from mise à jour user
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userLogin);
            $entityManager->flush();
            $this->addFlash('success', 'Votre profil a été mis à jour!');
        }

//        si on soumets l'inscription à un trip
        if ($formTripRegistration->isSubmitted() && $formTripRegistration->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

// query qui permet de récupérer le nb de plogeurs inscrits à une sortie et le nb maw pour cette sortie
            // si inf on enregistre le plongeur avec Inscrit sinon on le met en liste d'attente
            $tripIsFull = $this->getDoctrine()
                ->getRepository(Participant::class)
                ->findTripFull($participant->getTrip());

//            en fct du résultats on enregistre si en liste d'attente ou non
            if ($tripIsFull[0]['inscrit'] < $tripIsFull[0]['diverMax']) {
                $participant->setStatus('inscrit à la sortie');
                $this->addFlash('success', 'Vous etes inscrit à la sortie!');
            } else {
                $participant->setStatus('En liste d\'attente');
                $this->addFlash('success', 'ATTENTION, cette sortie esrt déja pleine, vous etes en liste d\'attente!');
            }


//            mise en place de l'inscription statut de base
//            TODO: voir le niveau le plus bas pour une inscription et rechercher cette objet
            /** @var InscriptionStatus $inscriptionStatus */
            $inscriptionStatus = $this->getDoctrine()
                ->getRepository(InscriptionStatus::class)
                ->findOneBy(['name' => 'Démarrage']);

            $participant->setInscriptionStatus($inscriptionStatus);
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
                $this->addFlash('success', 'Vous etes déinscrit à cette sortie!');
            }
        }

//        liste des sorties ou le user est inscrits
        /* @var  Collection|Participant[] $alreadyBookedTrips */
        $alreadyBookedTrips = $this->getDoctrine()
            ->getRepository(Participant::class)
            ->findBy(['user' => $userLogin]);

        //on recupere la liste des sorties
        $trips = $this->getDoctrine()
            ->getRepository(Trip::class)
            ->findAll();

//        listes des sorties non bookés
        $bookedTrip = [];
        $notBookedTrip = [];

        /* @var  Trip $book */
        foreach ($alreadyBookedTrips as $book) {
            $bookedTrip[] = $book->getTrip();
        }

        foreach ($trips as $trip) {
            if (!in_array($trip, $bookedTrip)) {
                $notBookedTrip[] = $trip;
            }
        }

        //on recupere la liste des documents
        $documents = $this->getDoctrine()
            ->getRepository(Document::class)
            ->findAll();

        //on recupere les documents de l'adhérent
        $inscription = null;
        $formUploaded = new Inscription();
        $formDocuments = $this->createForm(InscriptionType::class, $formUploaded);
        $formDocuments->handleRequest($request);

        if ($formDocuments->isSubmitted()) {
            $inscription = $this->getDoctrine()
                ->getRepository(Inscription::class)
                ->findOneBy(['user' => $userLogin]);

            $internalProcedure = $formDocuments['internalProcedure']->getData();
            $medicalCertificate = $formDocuments['medicalCertificate']->getData();
            $inscriptionSheet = $formDocuments['inscriptionSheet']->getData();
            $imageRight = $formDocuments['imageRight']->getData();

            if ($internalProcedure) {
                $fileName = 'Reglement_' . $this->getUser()->getId() . '.' . $internalProcedure->guessExtension();
//                 moves the file to the directory where brochures are stored
                $destination = $this->getParameter('doc_user_upload');
                $internalProcedure->move($destination, $fileName);
                if ($inscription !== null) {
                    $inscription->setInternalProcedure($fileName);
                }
            }

            if ($medicalCertificate) {
                $fileName = 'Certificat_' . $this->getUser()->getId() . '.' . $medicalCertificate->guessExtension();
//                 moves the file to the directory where brochures are stored
                $destination = $this->getParameter('doc_user_upload');
                $medicalCertificate->move($destination, $fileName);
                if ($inscription !== null) {
                    $inscription->setMedicalCertificate($fileName);
                }
            }

            if ($inscriptionSheet) {
                $fileName = 'Inscription_' . $this->getUser()->getId() . '.' . $inscriptionSheet->guessExtension();
//                 moves the file to the directory where brochures are stored
                $destination = $this->getParameter('doc_user_upload');
                $inscriptionSheet->move($destination, $fileName);
                if ($inscription !== null) {
                    $inscription->setInscriptionSheet($fileName);
                }
            }

            if ($imageRight) {
                $fileName = 'Droits_Image_' . $this->getUser()->getId() . '.' . $imageRight->guessExtension();
//                 moves the file to the directory where brochures are stored
                $destination = $this->getParameter('doc_user_upload');
                $imageRight->move($destination, $fileName);
                if ($inscription !== null) {
                    $inscription->setImageRight($fileName);
                }
            }

            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('user/show.html.twig', [
            'user' => $userLogin,
            'form' => $form,
            'formTripRegistration' => $formTripRegistration,
            'formTripCancellation' => $formTripCancellation,
//            'trips' => $trips,
            'tripsAlreadyBook' => $alreadyBookedTrips,
            'tripsNotBooked' => $notBookedTrip,
            'documents' => $documents,
            'inscription' => $inscription,
            'formDocuments' => $formDocuments
        ]);
    }
}
