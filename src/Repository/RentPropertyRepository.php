<?php

namespace App\Repository;

use App\Entity\RentProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RentProperty>
 *
 * @method RentProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentProperty[]    findAll()
 * @method RentProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentPropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentProperty::class);
    }

//    /**
//     * @return RentProperty[] Returns an array of RentProperty objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RentProperty
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
