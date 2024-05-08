<?php

namespace App\Repository;

use App\Entity\RegistredUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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

    public function remove(RegistredUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
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
        if (!isset($data->username) || !isset($data->password) || !isset($data->nickname)) {
            return false;
        }
        $user = new RegistredUser();
        $hashedPassword = $passwordHasher->hashPassword($user, $data->password);
        $email = strtolower($data->username);
        $user
            ->setEmail($email)
            ->setPassword($hashedPassword)
            ->setNickname($data->nickname);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        $newUser = $this->findOneBy(['email' => $email, 'nickname' => $data->nickname]);
        if (is_null($newUser)) {
            return false;
        }
        return true;
    }

    public function deleteUser(object $dataUser): bool
    {
        if (!isset($dataUser)) {
            return false;
        }
        $user = $this->findOneBy(
            [
                'email' => strtolower($dataUser->username),
                'nickname' => $dataUser->nickname
            ]
        );
        if (is_null($user)) {
            return false;
        }
        $this->remove($user, true);
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
