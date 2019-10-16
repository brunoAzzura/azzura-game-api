<?php

namespace App\Repository;

use App\Entity\PuzzleGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PuzzleGame|null find($id, $lockMode = null, $lockVersion = null)
 * @method PuzzleGame|null findOneBy(array $criteria, array $orderBy = null)
 * @method PuzzleGame[]    findAll()
 * @method PuzzleGame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PuzzleGameRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PuzzleGame::class);
    }

//    /**
//     * @return PuzzleGame[] Returns an array of PuzzleGame objects
//     */
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
    public function findOneBySomeField($value): ?PuzzleGame
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
