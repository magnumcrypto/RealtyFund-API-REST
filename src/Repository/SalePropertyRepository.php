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

    public function findOrderlyPropertiesJSON(object $filters, InvestmentsRepository $investmentsRepository): ?array
    {
        if ($filters->disponibilidad !== '1' && $filters->disponibilidad !== '0') {
            $disponibilidad = [];
        } else {
            $disponibilidad = ['disponibilidad' => boolval($filters->disponibilidad)];
        }
        $orden_alfabetico = ($filters->orden_alfabetico === '') ? null : $filters->orden_alfabetico;
        $precio = ($filters->precio === '') ? null : $filters->precio;
        //dump($disponibilidad, $orden_alfabetico, $precio); // dump($disponibilidad, $orden_alfabetico, $precio
        $criterios = [];
        if ($orden_alfabetico !== null) {
            $criterios['tipo_inmueble'] = $orden_alfabetico;
        }
        if ($precio !== null) {
            $criterios['precio'] = $precio;
        }
        $salesProperty = $this->findBy($disponibilidad, $criterios);
        if (is_null($salesProperty)) {
            return null;
        }
        $propertyJSON = [];
        foreach ($salesProperty as $key => $property) {
            $percent = ((int)$investmentsRepository->getCapitalByProperty($property->getId(), null) === 0) ? 0 : ($investmentsRepository->getCapitalByProperty($property->getId(), null) * 100) / $property->getPrecio();
            $propertyJSON[$key] =
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
        return $propertyJSON;
    }
}
