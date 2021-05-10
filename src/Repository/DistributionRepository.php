<?php

namespace App\Repository;

use App\Entity\Distribution;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Distribution|null find($id, $lockMode = null, $lockVersion = null)
 * @method Distribution|null findOneBy(array $criteria, array $orderBy = null)
 * @method Distribution[]    findAll()
 * @method Distribution[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DistributionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Distribution::class);
    }

    // /**
    //  * @return Distribution[] Returns an array of Distribution objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Distribution
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
