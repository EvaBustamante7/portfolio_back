<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ExpLaboralRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpLaboralRepository::class)]
#[ApiResource]
class ExpLaboral
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $empresa = null;

    #[ORM\Column(length: 255)]
    private ?string $puesto = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_ini = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha_end = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmpresa(): ?string
    {
        return $this->empresa;
    }

    public function setEmpresa(string $empresa): static
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getPuesto(): ?string
    {
        return $this->puesto;
    }

    public function setPuesto(string $puesto): static
    {
        $this->puesto = $puesto;

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

    public function getFechaIni(): ?\DateTimeInterface
    {
        return $this->fecha_ini;
    }

    public function setFechaIni(\DateTimeInterface $fecha_ini): static
    {
        $this->fecha_ini = $fecha_ini;

        return $this;
    }

    public function getFechaEnd(): ?\DateTimeInterface
    {
        return $this->fecha_end;
    }

    public function setFechaEnd(?\DateTimeInterface $fecha_end): static
    {
        $this->fecha_end = $fecha_end;

        return $this;
    }
}
