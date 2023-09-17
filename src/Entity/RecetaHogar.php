<?php

namespace App\Entity;

use App\Repository\RecetaHogarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetaHogarRepository::class)]
class RecetaHogar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $diaDeEjecucion = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $orden = null;

    #[ORM\ManyToOne(inversedBy: 'recetasHogar')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Receta $receta = null;

    #[ORM\ManyToOne(inversedBy: 'recetaHogars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hogar $hogar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiaDeEjecucion(): ?\DateTimeInterface
    {
        return $this->diaDeEjecucion;
    }

    public function setDiaDeEjecucion(\DateTimeInterface $diaDeEjecucion): static
    {
        $this->diaDeEjecucion = $diaDeEjecucion;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(int $orden): static
    {
        $this->orden = $orden;

        return $this;
    }

    public function getReceta(): ?Receta
    {
        return $this->receta;
    }

    public function setReceta(?Receta $receta): static
    {
        $this->receta = $receta;

        return $this;
    }

    public function getHogar(): ?Hogar
    {
        return $this->hogar;
    }

    public function setHogar(?Hogar $hogar): static
    {
        $this->hogar = $hogar;

        return $this;
    }
}
