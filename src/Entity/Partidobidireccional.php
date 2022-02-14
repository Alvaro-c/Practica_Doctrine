<?php

namespace App\Entity;

use App\Repository\PartidobidireccionalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartidobidireccionalRepository::class)]
class Partidobidireccional
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(targetEntity: "Equipobidireccional", inversedBy: "Partidos")]
    #[ORM\JoinColumn(name: "localIdBid", referencedColumnName: "local")]
    #[ORM\Column(type: 'integer')]
    private $local;

    #[ORM\ManyToOne(targetEntity: "Equipobidireccional", inversedBy: "Partidos")]
    #[ORM\JoinColumn(name: "localIdBid", referencedColumnName: "visitante")]
    #[ORM\Column(type: 'integer')]
    private $visitante;

    #[ORM\Column(type: 'integer')]
    private $goles_local;

    #[ORM\Column(type: 'integer')]
    private $goles_visitante;

    #[ORM\Column(type: 'string', length: 255)]
    private $fecha;

    #[ORM\OneToOne(targetEntity: "Partidosbidireccional", inversedBy: "Partidos")]
    #[ORM\JoinColumn(name: "equipoIdBid", referencedColumnName: "id")]
    private $PartidosBid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocal(): ?int
    {
        return $this->local;
    }

    public function setLocal(int $local): self
    {
        $this->local = $local;

        return $this;
    }

    public function getVisitante(): ?int
    {
        return $this->visitante;
    }

    public function setVisitante(int $visitante): self
    {
        $this->visitante = $visitante;

        return $this;
    }

    public function getGolesLocal(): ?int
    {
        return $this->goles_local;
    }

    public function setGolesLocal(int $goles_local): self
    {
        $this->goles_local = $goles_local;

        return $this;
    }

    public function getGolesVisitante(): ?int
    {
        return $this->goles_visitante;
    }

    public function setGolesVisitante(int $goles_visitante): self
    {
        $this->goles_visitante = $goles_visitante;

        return $this;
    }

    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }
}
