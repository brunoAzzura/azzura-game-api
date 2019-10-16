<?php

namespace App\Repository;

use App\Entity\PuzzlePiece;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PuzzlePiece|null find($id, $lockMode = null, $lockVersion = null)
 * @method PuzzlePiece|null findOneBy(array $criteria, array $orderBy = null)
 * @method PuzzlePiece[]    findAll()
 * @method PuzzlePiece[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PuzzlePieceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PuzzlePiece::class);
    }

   /**
    * @return PuzzlePiece[] Returns an array of PuzzlePiece objects
    */
    public function findAllPuzzleGamePiecesGreaterThanOrder($puzzleGameId, $order)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.pieceOrder > :order')
            ->innerJoin('p.puzzleGame', 'g')
            ->andWhere('g.id = :puzzleGameId')
            ->setParameter('order', $order)
            ->setParameter('puzzleGameId', $puzzleGameId)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?PuzzlePiece
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
