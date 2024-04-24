<?php

namespace App\Repository;

use App\Entity\RegistredUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<RegistredUser>
 * @implements PasswordUpgraderInterface<RegistredUser>
 *
 * @method RegistredUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegistredUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegistredUser[]    findAll()
 * @method RegistredUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistredUserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegistredUser::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof RegistredUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function registerUser(object $data, UserPasswordHasherInterface $passwordHasher): bool
    {
        if (!isset($data->username) || !isset($data->password)) {
            return false;
        }
        $user = new RegistredUser();
        $hashedPassword = $passwordHasher->hashPassword($user, $data->password);
        $user
            ->setEmail($data->username)
            ->setPassword($hashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        $newUser = $this->findOneBy(['email' => $data->username]);
        if (is_null($newUser)) {
            return false;
        }
        return true;
    }

    //    /**
    //     * @return RegistredUser[] Returns an array of RegistredUser objects
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

    //    public function findOneBySomeField($value): ?RegistredUser
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
