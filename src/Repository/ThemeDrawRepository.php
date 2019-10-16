<?php

namespace App\Repository;

use App\Entity\ThemeDraw;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ThemeDraw|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThemeDraw|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThemeDraw[]    findAll()
 * @method ThemeDraw[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeDrawRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ThemeDraw::class);
    }

//    /**
//     * @return ThemeDraw[] Returns an array of ThemeDraw objects
//     */
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
    public function findOneBySomeField($value): ?ThemeDraw
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
