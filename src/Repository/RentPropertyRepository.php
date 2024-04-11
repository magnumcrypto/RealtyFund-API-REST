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

    public function findAllJSON(InvestmentsRepository $investmentsRepository): ?array
    {
        $rentsProperty = $this->findAll();
        $propertyJSON = [];
        foreach ($rentsProperty as $property) {
            $percent = ((int)$investmentsRepository->getCapitalByProperty(null, $property->getId()) === 0) ? 0 : ($investmentsRepository->getCapitalByProperty(null, $property->getId()) * 100) / $property->getPrecio();
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
                        'capital_aportado' => $investmentsRepository->getCapitalByProperty(null, $property->getId()),
                        'porcentaje_invertido' => round($percent)
                    ]
                ];
        }
        if (is_null($propertyJSON)) {
            return null;
        }
        return $propertyJSON;
    }
}
