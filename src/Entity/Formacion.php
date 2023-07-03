<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FormacionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormacionRepository::class)]
#[ApiResource]
class Formacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $centro = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_ini = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha_end = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getCentro(): ?string
    {
        return $this->centro;
    }

    public function setCentro(string $centro): static
    {
        $this->centro = $centro;

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
