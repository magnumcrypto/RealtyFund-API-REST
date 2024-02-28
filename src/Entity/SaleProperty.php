<?php

namespace App\Entity;

use App\Repository\SalePropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalePropertyRepository::class)]
#[ORM\Table(name: 'sale_property')]
class SaleProperty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'inmueble_id')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo_inmueble = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 18, scale: 2)]
    private ?float $precio = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $direccion = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $informacion_detallada = null;

    #[ORM\Column(length: 255)]
    private ?string $zona = null;

    #[ORM\Column(options: ['default' => true])]
    private ?bool $disponibilidad = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $imagen = null;

    #[ORM\OneToMany(mappedBy: 'sale_property', targetEntity: Investments::class)]
    private Collection $investments;

    #[ORM\OneToOne(mappedBy: 'sale_property', cascade: ['persist', 'remove'], targetEntity: Exits::class)]
    private ?Exits $exit = null;

    public function __construct()
    {
        $this->investments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoInmueble(): ?string
    {
        return $this->tipo_inmueble;
    }

    public function setTipoInmueble(string $tipo_inmueble): static
    {
        $this->tipo_inmueble = $tipo_inmueble;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getInformacionDetallada(): ?string
    {
        return $this->informacion_detallada;
    }

    public function setInformacionDetallada(string $informacion_detallada): static
    {
        $this->informacion_detallada = $informacion_detallada;

        return $this;
    }

    public function getZona(): ?string
    {
        return $this->zona;
    }

    public function setZona(string $zona): static
    {
        $this->zona = $zona;

        return $this;
    }

    public function isDisponibilidad(): ?bool
    {
        return $this->disponibilidad;
    }

    public function setDisponibilidad(bool $disponibilidad): static
    {
        $this->disponibilidad = $disponibilidad;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * @return Collection<int, Investments>
     */
    public function getInvestments(): Collection
    {
        return $this->investments;
    }

    public function addInvestment(Investments $investment): static
    {
        if (!$this->investments->contains($investment)) {
            $this->investments->add($investment);
            $investment->setSaleProperty($this);
        }

        return $this;
    }

    public function removeInvestment(Investments $investment): static
    {
        if ($this->investments->removeElement($investment)) {
            // set the owning side to null (unless already changed)
            if ($investment->getSaleProperty() === $this) {
                $investment->setSaleProperty(null);
            }
        }

        return $this;
    }

    public function getExit(): ?Exits
    {
        return $this->exit;
    }

    public function setExit(Exits $exit): static
    {
        // set the owning side of the relation if necessary
        if ($exit->getSaleProperty() !== $this) {
            $exit->setSaleProperty($this);
        }

        $this->exit = $exit;

        return $this;
    }
}
