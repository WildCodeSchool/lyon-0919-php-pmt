<?php

namespace App\Repository;

use App\Entity\TypeTrip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeTrip|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeTrip|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeTrip[]    findAll()
 * @method TypeTrip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeTripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeTrip::class);
    }

    // /**
    //  * @return TypeTrip[] Returns an array of TypeTrip objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeTrip
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
