<?php

namespace App\Repository;

use App\Entity\Investments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Investments>
 *
 * @method Investments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Investments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Investments[]    findAll()
 * @method Investments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvestmentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Investments::class);
    }

//    /**
//     * @return Investments[] Returns an array of Investments objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Investments
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
