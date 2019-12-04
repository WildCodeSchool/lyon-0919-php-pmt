<?php

namespace App\Repository;

use App\Entity\InscriptionStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method InscriptionStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method InscriptionStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method InscriptionStatus[]    findAll()
 * @method InscriptionStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InscriptionStatus::class);
    }

    // /**
    //  * @return InscriptionStatus[] Returns an array of InscriptionStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InscriptionStatus
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
