<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\IdiomasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IdiomasRepository::class)]
#[ApiResource]
class Idiomas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idioma = null;

    #[ORM\Column(length: 255)]
    private ?string $nivel_hablado = null;

    #[ORM\Column(length: 255)]
    private ?string $nivel_escrito = null;

    #[ORM\Column(length: 255)]
    private ?string $titulacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdioma(): ?string
    {
        return $this->idioma;
    }

    public function setIdioma(string $idioma): static
    {
        $this->idioma = $idioma;

        return $this;
    }

    public function getNivelHablado(): ?string
    {
        return $this->nivel_hablado;
    }

    public function setNivelHablado(string $nivel_hablado): static
    {
        $this->nivel_hablado = $nivel_hablado;

        return $this;
    }

    public function getNivelEscrito(): ?string
    {
        return $this->nivel_escrito;
    }

    public function setNivelEscrito(string $nivel_escrito): static
    {
        $this->nivel_escrito = $nivel_escrito;

        return $this;
    }

    public function getTitulacion(): ?string
    {
        return $this->titulacion;
    }

    public function setTitulacion(string $titulacion): static
    {
        $this->titulacion = $titulacion;

        return $this;
    }
}
