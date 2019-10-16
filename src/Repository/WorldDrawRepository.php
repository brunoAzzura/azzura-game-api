<?php

namespace App\Repository;

use App\Entity\WorldDraw;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorldDraw|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorldDraw|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorldDraw[]    findAll()
 * @method WorldDraw[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorldDrawRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorldDraw::class);
    }

//    /**
//     * @return WorldDraw[] Returns an array of WorldDraw objects
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
    public function findOneBySomeField($value): ?WorldDraw
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
