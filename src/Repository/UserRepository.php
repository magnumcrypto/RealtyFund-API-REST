<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function insertUser(object $dataUser): ?User
    {
        if (
            !isset($dataUser->nombre) || !isset($dataUser->apellidos) || !isset($dataUser->direccion)
            || !isset($dataUser->email)  || !isset($dataUser->telefono) || !isset($dataUser->capital)
        ) {
            return null;
        }
        $edad = !isset($dataUser->edad) ? null : intval($dataUser->edad);
        $capitalAportado = floatval($dataUser->capital);
        $newUser = new User();
        $newUser
            ->setNombre($dataUser->nombre)
            ->setApellidos($dataUser->apellidos)
            ->setDireccion($dataUser->direccion)
            ->setEmail(strtolower($dataUser->email))
            ->setTelefono($dataUser->telefono)
            ->setCapitalAportado($capitalAportado)
            ->setEdad($edad);

        $this->save($newUser, true);
        $user = $this->findOneBy(
            [
                'id' => $newUser->getId(),
                'email' => $newUser->getEmail()
            ]
        );
        if (is_null($user)) {
            return null;
        }
        return $user;
    }
}
