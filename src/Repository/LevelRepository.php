<?php

namespace App\Repository;

use App\DataFixtures\LevelFixtures;
use App\Entity\Level;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Level|null find($id, $lockMode = null, $lockVersion = null)
 * @method Level|null findOneBy(array $criteria, array $orderBy = null)
 * @method Level[]    findAll()
 * @method Level[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Level::class);
    }

    public function findLevelsWithUsers()
    {
        $qb = $this->createQueryBuilder('l');
        return $qb
            ->join('l.users', 'u')
            ->where($qb->expr()->isNotNull('u.isMonitor'))
            ->andwhere('u.isMonitor = true ')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return LevelFixtures[] Returns an array of LevelFixtures objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
