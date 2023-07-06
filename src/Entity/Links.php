<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LinksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinksRepository::class)]
#[ApiResource]
class Links
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre_links = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreLinks(): ?string
    {
        return $this->nombre_links;
    }

    public function setNombreLinks(string $nombre_links): static
    {
        $this->nombre_links = $nombre_links;

        return $this;
    }
}
