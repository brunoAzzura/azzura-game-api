<?php

namespace App\Repository;

use App\Entity\GoodToKnow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GoodToKnow|null find($id, $lockMode = null, $lockVersion = null)
 * @method GoodToKnow|null findOneBy(array $criteria, array $orderBy = null)
 * @method GoodToKnow[]    findAll()
 * @method GoodToKnow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoodToKnowRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GoodToKnow::class);
    }

//    /**
//     * @return GoodToKnow[] Returns an array of GoodToKnow objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GoodToKnow
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    //@todo déplacer ces méthodes dans UserRepository ? + supprimer users de 

    public function findByUser($userId) {
        $qb = $this->createQueryBuilder('g')
        ->innerJoin('g.users', 'u')
        ->andWhere('u.id = :user_id')
        ->setParameter('user_id', $userId)
        ->getQuery();
        
        return $qb->execute();
    }

    public function getGoodToKnowToUnlock($userId, $themeId) {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT g
                FROM App\Entity\GoodToKnow g
                JOIN g.theme t
                WHERE t.id = :theme_id
                AND g.id NOT IN (
                    SELECT gt.id
                    FROM App\Entity\GoodToKnow gt
                    JOIN gt.users u
                    WHERE u.id = :user_id
                )
            '
        )->setParameter('user_id', $userId)
        ->setParameter('theme_id', $themeId);

        return $query->execute();
    }

    public function getNbGoodToKnowByWorld() {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT w.id, count(g) as nbGoodToKnow
             FROM App\Entity\GoodToKnow g
             JOIN g.theme t
             JOIN t.world w
             GROUP BY w.id
            '
        );
        // ->setParameter('user_id', $userId);
        return $query->execute();
    }

    public function getNbGoodToKnowByUserByWorld($userId) {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
        'SELECT w.id, count(g) as nbGoodToKnowUnlock
             FROM App\Entity\GoodToKnow g
             JOIN g.theme t
             JOIN t.world w
             JOIN g.users u
             WHERE u.id = :user_id
             GROUP BY w.id
            ')->setParameter('user_id', $userId);

        return $query->execute();
    }
}
