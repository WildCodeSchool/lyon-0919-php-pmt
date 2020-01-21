<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trip")
 */
class TripController extends AbstractController
{

    /**
     * @Route("/calendar", name="booking_calendar", methods={"GET"})
     * @return Response
     */
    public function calendar(): Response
    {
        return $this->render('booking/calendar.html.twig');
    }
}
