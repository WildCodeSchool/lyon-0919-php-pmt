<?php

namespace App\EventListener;

use App\Entity\Trip;
use App\Repository\TripRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Toiba\FullCalendarBundle\Entity\Event;
use Toiba\FullCalendarBundle\Event\CalendarEvent;

class FullCalendarListener
{
    private $router;
    /**
     * @var TripRepository
     */
    private $tripRepository;

    public function __construct(
        TripRepository $tripRepository,
        UrlGeneratorInterface $router
    ) {
        $this->tripRepository = $tripRepository;
        $this->router = $router;
    }

    public function loadEvents(CalendarEvent $calendar)
    {
        $startDate = $calendar->getStart();
        $endDate = $calendar->getEnd();
        $calendar->getFilters();
        $bookings = $this->tripRepository->findTripBetwennDates($startDate, $endDate);
        foreach ($bookings as $trip) {
            $tripEvent = new Event(
                $trip->getName(),
                $trip->getDateStart(),
                $trip->getDateEnd()
            );
            $tripEvent->setUrl(
                $this->router->generate('booking_calendar', [
                    'id' => $trip->getId(),
                ])
            );
            $calendar->addEvent($tripEvent);
        }
    }
}
