<?php

namespace App\Entity;

use App\Repository\LigaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigaRepository::class)]
class Liga
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Pais;

    #[ORM\Column(type: 'string', length: 255)]
    private $Nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $Division;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPais(): ?string
    {
        return $this->Pais;
    }

    public function setPais(string $Pais): self
    {
        $this->Pais = $Pais;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getDivision(): ?string
    {
        return $this->Division;
    }

    public function setDivision(string $Division): self
    {
        $this->Division = $Division;

        return $this;
    }
}
