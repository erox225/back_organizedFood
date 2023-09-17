<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $UserName = null;

    #[ORM\Column(length: 20)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaModificacion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaCreacion = null;

    #[ORM\ManyToMany(targetEntity: Hogar::class, inversedBy: 'usuarios')]
    private Collection $Hogares;

    #[ORM\ManyToMany(targetEntity: Receta::class, inversedBy: 'usuarios')]
    private Collection $Recetas;

    public function __construct()
    {
        $this->Hogares = new ArrayCollection();
        $this->Recetas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->UserName;
    }

    public function setUserName(string $UserName): static
    {
        $this->UserName = $UserName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getFechaModificacion(): ?\DateTimeInterface
    {
        return $this->fechaModificacion;
    }

    public function setFechaModificacion(\DateTimeInterface $fechaModificacion): static
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fechaCreacion): static
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * @return Collection<int, Hogar>
     */
    public function getHogares(): Collection
    {
        return $this->Hogares;
    }

    public function addHogare(Hogar $hogare): static
    {
        if (!$this->Hogares->contains($hogare)) {
            $this->Hogares->add($hogare);
        }

        return $this;
    }

    public function removeHogare(Hogar $hogare): static
    {
        $this->Hogares->removeElement($hogare);

        return $this;
    }

    /**
     * @return Collection<int, Receta>
     */
    public function getRecetas(): Collection
    {
        return $this->Recetas;
    }

    public function addReceta(Receta $receta): static
    {
        if (!$this->Recetas->contains($receta)) {
            $this->Recetas->add($receta);
        }

        return $this;
    }

    public function removeReceta(Receta $receta): static
    {
        $this->Recetas->removeElement($receta);

        return $this;
    }
}
