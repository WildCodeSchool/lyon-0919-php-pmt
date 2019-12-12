<?php

namespace App\Repository;

use App\Entity\Insurance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Insurance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Insurance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Insurance[]    findAll()
 * @method Insurance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InsuranceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Insurance::class);
    }

    // /**
    //  * @return Insurance[] Returns an array of Insurance objects
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
    public function findOneBySomeField($value): ?Insurance
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
