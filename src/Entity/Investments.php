<?php

namespace App\Entity;

use App\Repository\InvestmentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvestmentsRepository::class)]
#[ORM\Table(name: 'investments')]
class Investments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'investment_id')]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 18, scale: 2)]
    private ?float $capital_aportado = null;

    #[ORM\ManyToOne(inversedBy: 'investments', targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, name: 'id_user', referencedColumnName: 'user_id')]
    private ?User $usuario = null;

    #[ORM\ManyToOne(inversedBy: 'investments', targetEntity: SaleProperty::class)]
    #[ORM\JoinColumn(nullable: true, name: 'saleproperty_id', referencedColumnName: 'inmueble_id')]
    private ?SaleProperty $sale_property = null;

    #[ORM\ManyToOne(inversedBy: 'investments', targetEntity: RentProperty::class)]
    #[ORM\JoinColumn(nullable: true, name: 'rentproperty_id', referencedColumnName: 'inmueble_id')]
    private ?RentProperty $rent_property = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapitalAportado(): ?float
    {
        return $this->capital_aportado;
    }

    public function setCapitalAportado(float $capital_aportado): static
    {
        $this->capital_aportado = $capital_aportado;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getSaleProperty(): ?SaleProperty
    {
        return $this->sale_property;
    }

    public function setSaleProperty(?SaleProperty $sale_property): static
    {
        $this->sale_property = $sale_property;

        return $this;
    }

    public function getRentProperty(): ?RentProperty
    {
        return $this->rent_property;
    }

    public function setRentProperty(?RentProperty $rent_property): static
    {
        $this->rent_property = $rent_property;

        return $this;
    }
}
