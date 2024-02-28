<?php

namespace App\Entity;

use App\Repository\ExitsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExitsRepository::class)]
#[ORM\Table(name: 'exits')]
class Exits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'exit_id')]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 18, scale: 2)]
    private ?float $precio_compra = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 18, scale: 2)]
    private ?float $precio_venta = null;

    #[ORM\Column(name: 'porcentaje_rentabilidad', type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?float $rentabilidad = null;

    #[ORM\OneToOne(inversedBy: 'exit', cascade: ['persist', 'remove'], targetEntity: SaleProperty::class)]
    #[ORM\JoinColumn(nullable: false, name: 'id_inmueble', referencedColumnName: 'inmueble_id')]
    private ?SaleProperty $sale_property = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecioCompra(): ?float
    {
        return $this->precio_compra;
    }

    public function setPrecioCompra(float $precio_compra): static
    {
        $this->precio_compra = $precio_compra;

        return $this;
    }

    public function getPrecioVenta(): ?float
    {
        return $this->precio_venta;
    }

    public function setPrecioVenta(float $precio_venta): static
    {
        $this->precio_venta = $precio_venta;

        return $this;
    }

    public function getRentabilidad(): ?float
    {
        return $this->rentabilidad;
    }

    public function setRentabilidad(float $rentabilidad): static
    {
        $this->rentabilidad = $rentabilidad;

        return $this;
    }

    public function getSaleProperty(): ?SaleProperty
    {
        return $this->sale_property;
    }

    public function setSaleProperty(SaleProperty $sale_property): static
    {
        $this->sale_property = $sale_property;

        return $this;
    }
}
