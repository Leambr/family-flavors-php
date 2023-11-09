<?php

namespace App\Infrastructure\Repository;

use App\Domain\DishType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DishType>
 *
 * @method DishType|null find($id, $lockMode = null, $lockVersion = null)
 * @method DishType|null findOneBy(array $criteria, array $orderBy = null)
 * @method DishType[]    findAll()
 * @method DishType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DishTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DishType::class);
    }

//    /**
//     * @return DishType[] Returns an array of DishType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DishType
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
