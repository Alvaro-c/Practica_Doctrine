<?php

namespace App\Entity;

use App\Repository\JugadorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JugadorRepository::class)]
class Jugador
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
    private $Edad;

    #[ORM\ManyToOne(targetEntity: "Equipo")]
    #[ORM\JoinColumn(name: "equipo_id", referencedColumnName: "id")]
    private $Equipo;

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

    public function getEdad(): ?int
    {
        return $this->Edad;
    }

    public function setEdad(int $Edad): self
    {
        $this->Edad = $Edad;

        return $this;
    }

    //Al estar el campo equipo relaciones con la entidad equipo, lo que devuelve get un objeto de la clase equipo
    public function getEquipo(): ?Equipo
    {
        return $this->Equipo;
    }
    //Al estar el campo equipo relaciones con la entidad equipo, lo que espera set es un objeto de la clase equipo
    public function setEquipo(Equipo $Equipo): self
    {
        $this->Equipo = $Equipo;

        return $this;
    }

}
