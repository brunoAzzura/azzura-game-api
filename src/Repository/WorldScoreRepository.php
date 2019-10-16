<?php

namespace App\Repository;

use App\Entity\WorldScore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorldScore|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorldScore|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorldScore[]    findAll()
 * @method WorldScore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorldScoreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorldScore::class);
    }

//    /**
//     * @return WorldScore[] Returns an array of WorldScore objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorldScore
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
