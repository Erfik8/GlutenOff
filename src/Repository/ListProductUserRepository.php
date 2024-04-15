<?php

namespace App\Repository;

use App\Entity\ListProductUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListProductUser>
 *
 * @method ListProductUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListProductUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListProductUser[]    findAll()
 * @method ListProductUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListProductUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListProductUser::class);
    }

    //    /**
    //     * @return ListProductUser[] Returns an array of ListProductUser objects
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

    //    public function findOneBySomeField($value): ?ListProductUser
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
