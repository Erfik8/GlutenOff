<?php

namespace App\Repository;

use App\Entity\ListShopLikes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListShopLikes>
 *
 * @method ListShopLikes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListShopLikes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListShopLikes[]    findAll()
 * @method ListShopLikes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListShopLikesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListShopLikes::class);
    }

    //    /**
    //     * @return ListShopLikes[] Returns an array of ListShopLikes objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ListShopLikes
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
