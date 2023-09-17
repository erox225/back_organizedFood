<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaCreacion = null;

    #[ORM\ManyToMany(targetEntity: Receta::class, mappedBy: 'productos')]
    private Collection $recetas;

    #[ORM\ManyToMany(targetEntity: Hogar::class, mappedBy: 'productos')]
    private Collection $hogares;

    #[ORM\OneToMany(mappedBy: 'Producto', targetEntity: ListaCompra::class, orphanRemoval: true)]
    private Collection $listaCompras;

    public function __construct()
    {
        $this->recetas = new ArrayCollection();
        $this->hogares = new ArrayCollection();
        $this->listaCompras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

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
     * @return Collection<int, Receta>
     */
    public function getRecetas(): Collection
    {
        return $this->recetas;
    }

    public function addReceta(Receta $receta): static
    {
        if (!$this->recetas->contains($receta)) {
            $this->recetas->add($receta);
            $receta->addProducto($this);
        }

        return $this;
    }

    public function removeReceta(Receta $receta): static
    {
        if ($this->recetas->removeElement($receta)) {
            $receta->removeProducto($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Hogar>
     */
    public function getHogares(): Collection
    {
        return $this->hogares;
    }

    public function addHogare(Hogar $hogare): static
    {
        if (!$this->hogares->contains($hogare)) {
            $this->hogares->add($hogare);
            $hogare->addProducto($this);
        }

        return $this;
    }

    public function removeHogare(Hogar $hogare): static
    {
        if ($this->hogares->removeElement($hogare)) {
            $hogare->removeProducto($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ListaCompra>
     */
    public function getListaCompras(): Collection
    {
        return $this->listaCompras;
    }

    public function addListaCompra(ListaCompra $listaCompra): static
    {
        if (!$this->listaCompras->contains($listaCompra)) {
            $this->listaCompras->add($listaCompra);
            $listaCompra->setProducto($this);
        }

        return $this;
    }

    public function removeListaCompra(ListaCompra $listaCompra): static
    {
        if ($this->listaCompras->removeElement($listaCompra)) {
            // set the owning side to null (unless already changed)
            if ($listaCompra->getProducto() === $this) {
                $listaCompra->setProducto(null);
            }
        }

        return $this;
    }
}
