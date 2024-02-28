<?php

namespace App\Repository;

use App\Entity\SaleProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SaleProperty>
 *
 * @method SaleProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaleProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaleProperty[]    findAll()
 * @method SaleProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalePropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaleProperty::class);
    }

//    /**
//     * @return SaleProperty[] Returns an array of SaleProperty objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SaleProperty
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
