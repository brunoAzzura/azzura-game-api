<?php

namespace App\Repository;

use App\Entity\BonusInvestment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BonusInvestment|null find($id, $lockMode = null, $lockVersion = null)
 * @method BonusInvestment|null findOneBy(array $criteria, array $orderBy = null)
 * @method BonusInvestment[]    findAll()
 * @method BonusInvestment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BonusInvestmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BonusInvestment::class);
    }

    // /**
    //  * @return BonusInvestment[] Returns an array of BonusInvestment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BonusInvestment
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getBonusToUnlock($userId) {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT b
                FROM App\Entity\BonusInvestment b
                 WHERE b.id NOT IN (
                    SELECT bt.id
                    FROM App\Entity\BonusInvestment bt
                    JOIN bt.users u
                    WHERE u.id = :user_id
                )
            '
        )->setParameter('user_id', $userId);

        return $query->execute();
    }
}
