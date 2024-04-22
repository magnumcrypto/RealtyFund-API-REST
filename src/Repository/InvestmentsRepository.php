<?php

namespace App\Repository;

use App\Entity\Investments;
use App\Entity\SaleProperty;
use App\Entity\User;
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
    public function save(Investments $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Investments $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function insertInvestment(User $user, SaleProperty $saleProperty): ?Investments
    {
        $newInvestment = new Investments();
        $newInvestment
            ->setCapitalAportado($user->getCapitalAportado())
            ->setUsuario($user)
            ->setSaleProperty($saleProperty);
        $this->save($newInvestment, true);

        $investment = $this->findOneBy(
            [
                'id' => $newInvestment->getId(),
                'usuario' => $user,
                'sale_property' => $saleProperty
            ]
        );
        if (is_null($investment)) {
            return null;
        }
        return $investment;
    }

    public function getCapitalByProperty(?int $idSaleProperty, ?int $idRentProperty): float
    {
        if (is_null($idRentProperty)) {
            $investments = $this->findBy(['sale_property' => $idSaleProperty]);
        } else {
            $investments = $this->findBy(['rent_property' => $idRentProperty]);
        }
        $capitalAportado = 0;
        foreach ($investments as $invest) {
            $capitalAportado += $invest->getCapitalAportado();
        }
        if (empty($capitalAportado)) {
            return 0;
        }
        return $capitalAportado;
    }
}
