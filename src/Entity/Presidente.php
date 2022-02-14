<?php

namespace App\Entity;

use App\Repository\PresidenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresidenteRepository::class)]
class Presidente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $Apellidos;

    #[ORM\Column(type: 'integer')]
    private $Equipo;

    #[ORM\Column(type: 'integer')]
    private $Posesion;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getApellidos(): ?string
    {
        return $this->Apellidos;
    }

    public function setApellidos(string $Apellidos): self
    {
        $this->Apellidos = $Apellidos;

        return $this;
    }

    public function getEquipo(): ?int
    {
        return $this->Equipo;
    }

    public function setEquipo(int $Equipo): self
    {
        $this->Equipo = $Equipo;

        return $this;
    }

    public function getPosesion(): ?int
    {
        return $this->Posesion;
    }

    public function setPosesion(int $Posesion): self
    {
        $this->Posesion = $Posesion;

        return $this;
    }
}
