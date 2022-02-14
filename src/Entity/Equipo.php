<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipoRepository::class)]
class Equipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $Socios;

    #[ORM\Column(type: 'integer')]
    private $Fundacion;

    #[ORM\Column(type: 'string', length: 255)]
    private $Ciudad;

    #[ORM\ManyToOne(targetEntity: "Liga")]
    #[ORM\JoinColumn(name: "liga_id", referencedColumnName: "id")]
    private $liga;

    #[ORM\ManyToOne(targetEntity: "Presidente")]
    #[ORM\JoinColumn(name: "presidente_id", referencedColumnName: "id")]
    private $presidente;

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

    public function getSocios(): ?string
    {
        return $this->Socios;
    }

    public function setSocios(string $Socios): self
    {
        $this->Socios = $Socios;

        return $this;
    }
    public function getFundacion(): ?int
    {
        return $this->Fundacion;
    }

    public function setFundacion(string $Fundacion): self
    {
        $this->Fundacion = $Fundacion;

        return $this;
    }
    public function getCiudad(): ?string
    {
        return $this->Ciudad;
    }

    public function setCiudad(string $Ciudad): self
    {
        $this->Ciudad = $Ciudad;

        return $this;
    }

    public function getLiga(): ?Liga
    {
        return $this->liga;
    }

    public function setLiga(?Liga $liga): self
    {
        $this->liga = $liga;

        return $this;
    }

    public function getPresidente(): ?Presidente
    {
        return $this->presidente;
    }

    public function setPresidente(?Presidente $presidente): self
    {
        $this->presidente = $presidente;

        return $this;
    }

}
