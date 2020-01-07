<?php

namespace App\Form;

use App\Entity\Trip;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TripToNumberTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (trip) to a id (number).
     *
     * @param Trip|null $trip
     * @return integer
     */
    public function transform($trip)
    {
        if (null === $trip) {
            return -1;
        }
        return intval($trip->getId());
    }

    /**
     * Transforms a id (number) to an object (trip).
     *
     * @param int $tripId
     * @return Trip|null
     * @throws TransformationFailedException if object (trip) is not found.
     */
    public function reverseTransform($tripId)
    {
        // no issue number? It's optional, so that's ok
        if (!$tripId) {
            return null;
        }

        $trip = $this->entityManager
            ->getRepository(Trip::class)
            // query for the issue with this id
            ->find($tripId);

        if (null === $trip) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An trip with id "%s" does not exist!',
                $tripId
            ));
        }
        return $trip;
    }
}
