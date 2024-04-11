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
    public function findAllJSON(InvestmentsRepository $investmentsRepository): ?array
    {
        $salesProperty = $this->findAll();
        $propertyJSON = [];
        foreach ($salesProperty as $property) {
            $percent = ((int)$investmentsRepository->getCapitalByProperty($property->getId(), null) === 0) ? 0 : ($investmentsRepository->getCapitalByProperty($property->getId(), null) * 100) / $property->getPrecio();
            $propertyJSON[$property->getId()] =
                [
                    'data' =>
                    [
                        'id' => $property->getId(),
                        'tipo_inmueble' => $property->getTipoInmueble(),
                        'precio' => $property->getPrecio(),
                        'direccion' => $property->getDireccion(),
                        'descripcion' => $property->getDescripcion(),
                        'informacion_detallada' => $property->getInformacionDetallada(),
                        'zona' => $property->getZona(),
                        'disponibilidad' => $property->isDisponibilidad(),
                        'imagen' => $property->getImagen(),
                        'capital_aportado' => $investmentsRepository->getCapitalByProperty($property->getId(), null),
                        'porcentaje_invertido' => round($percent),
                    ]
                ];
        }
        if (is_null($propertyJSON)) {
            return null;
        }
        return $propertyJSON;
    }
}
