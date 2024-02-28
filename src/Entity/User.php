<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'user_id')]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 255)]
    private ?string $direccion = null;

    #[ORM\Column(length: 100, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 11)]
    private ?string $telefono = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 18, scale: 2)]
    private ?float $capital_aportado = null;

    #[ORM\Column(nullable: true)]
    private ?int $edad = null;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Investments::class)]
    private Collection $investments;

    public function __construct()
    {
        $this->investments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): static
    {
        $this->apellidos = $apellidos;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
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

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(?int $edad): static
    {
        $this->edad = $edad;

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
            $investment->setUsuario($this);
        }

        return $this;
    }

    public function removeInvestment(Investments $investment): static
    {
        if ($this->investments->removeElement($investment)) {
            // set the owning side to null (unless already changed)
            if ($investment->getUsuario() === $this) {
                $investment->setUsuario(null);
            }
        }

        return $this;
    }
}
