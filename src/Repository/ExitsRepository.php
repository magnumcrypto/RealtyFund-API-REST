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

    public function findAllJSON(): ?array
    {
        $exits = $this->findAll();
        $exitsJSON = [];
        foreach ($exits as $exit) {
            $property = $exit->getSaleProperty();
            $exitsJSON[$exit->getId()] =
                [
                    'data' => [
                        'tipo_inmueble' => $property->getTipoInmueble(),
                        'precio_compra' => $exit->getPrecioCompra(),
                        'precio_venta' => $exit->getPrecioVenta(),
                        'rentabilidad' => $exit->getRentabilidad(),
                        'descripcion' => $property->getDescripcion(),
                        'imagen' => $property->getImagen()
                    ]
                ];
        }
        if (empty($exitsJSON)) {
            return null;
        }
        return $exitsJSON;
    }
}
