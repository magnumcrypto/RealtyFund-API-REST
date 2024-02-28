<?php

namespace App\Repository;

use App\Entity\Exits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Exits>
 *
 * @method Exits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exits[]    findAll()
 * @method Exits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exits::class);
    }

//    /**
//     * @return Exits[] Returns an array of Exits objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Exits
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
