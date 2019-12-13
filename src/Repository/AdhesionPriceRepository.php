<?php

namespace App\Repository;

use App\Entity\AdhesionPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AdhesionPrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdhesionPrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdhesionPrice[]    findAll()
 * @method AdhesionPrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdhesionPriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdhesionPrice::class);
    }

    // /**
    //  * @return AdhesionPriceFixtures[] Returns an array of AdhesionPriceFixtures objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdhesionPriceFixtures
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
