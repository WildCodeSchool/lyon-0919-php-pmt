<?php

namespace App\Repository;

use App\Entity\Participant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Participant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participant[]    findAll()
 * @method Participant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participant::class);
    }


    public function findTripFull($trip)
    {
        $qb = $this->createQueryBuilder('p');

        return $qb->select('trip.id', 'trip.name', 'count(p.user) as inscrit', 'trip.nbDiver as diverMax')
//            ->add('select', $qb->expr()->lt('count(p.user)', 'trip.nbDiver'))
            ->join('p.trip', 'trip')
            ->join('p.user', 'user')
            ->andWhere('p.trip = :val')
            ->setParameter('val', $trip)
            ->groupBy('trip.id', 'trip.name')
            ->getQuery()
            ->getResult();
    }

//SELECT COUNT(user.lastname)< trip.nb_diver, trip.name
//FROM participant
//JOIN user ON participant.user_id = user.id
//JOIN trip ON participant.trip_id= trip.id
//GROUP BY trip.name, trip.nb_diver;
//+-------------------------------------+----------

    // /**
    //  * @return Participant[] Returns an array of Participant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Participant
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
