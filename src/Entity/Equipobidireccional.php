<?php

namespace App\Entity;

use App\Repository\EquipobidireccionalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipobidireccionalRepository::class)]
class Equipobidireccional
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

    #[ORM\OneToMany(targetEntity: "Jugadorbidireccional", mappedBy:"EquipoBid")]
    private $Jugadores;

    #[ORM\OneToMany(targetEntity: "Partidosbidireccional", mappedBy:"EquipoBid")]
    private $Partidos;

    public function __construct() {
        $this->Jugadores = new ArrayCollection();
        }

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

    public function getJugadores()
    {
        return $this->Jugadores;
    }

    public function addJugadore(Jugadorbidireccional $jugadore): self
    {
        if (!$this->Jugadores->contains($jugadore)) {
            $this->Jugadores[] = $jugadore;
            $jugadore->setEquipoBid($this);
        }

        return $this;
    }

    public function removeJugadore(Jugadorbidireccional $jugadore): self
    {
        if ($this->Jugadores->removeElement($jugadore)) {
            // set the owning side to null (unless already changed)
            if ($jugadore->getEquipoBid() === $this) {
                $jugadore->setEquipoBid(null);
            }
        }

        return $this;
    }

}
