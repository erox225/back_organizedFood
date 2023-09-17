<?php

namespace App\Entity;

use App\Repository\HogarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HogarRepository::class)]
class Hogar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaCreacion = null;

    #[ORM\ManyToMany(targetEntity: Usuario::class, mappedBy: 'Hogares')]
    private Collection $usuarios;

    #[ORM\ManyToMany(targetEntity: Producto::class, inversedBy: 'hogares')]
    private Collection $productos;

    #[ORM\OneToMany(mappedBy: 'Hogar', targetEntity: Receta::class, orphanRemoval: true)]
    private Collection $recetas;

    #[ORM\OneToMany(mappedBy: 'hogar', targetEntity: RecetaHogar::class, orphanRemoval: true)]
    private Collection $recetaHogars;

    #[ORM\OneToMany(mappedBy: 'hogar', targetEntity: ListaCompra::class, orphanRemoval: true)]
    private Collection $listaCompras;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
        $this->productos = new ArrayCollection();
        $this->recetas = new ArrayCollection();
        $this->recetaHogars = new ArrayCollection();
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
     * @return Collection<int, Usuario>
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuario $usuario): static
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios->add($usuario);
            $usuario->addHogare($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): static
    {
        if ($this->usuarios->removeElement($usuario)) {
            $usuario->removeHogare($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Producto>
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Producto $producto): static
    {
        if (!$this->productos->contains($producto)) {
            $this->productos->add($producto);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): static
    {
        $this->productos->removeElement($producto);

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
            $receta->setHogar($this);
        }

        return $this;
    }

    public function removeReceta(Receta $receta): static
    {
        if ($this->recetas->removeElement($receta)) {
            // set the owning side to null (unless already changed)
            if ($receta->getHogar() === $this) {
                $receta->setHogar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecetaHogar>
     */
    public function getRecetaHogars(): Collection
    {
        return $this->recetaHogars;
    }

    public function addRecetaHogar(RecetaHogar $recetaHogar): static
    {
        if (!$this->recetaHogars->contains($recetaHogar)) {
            $this->recetaHogars->add($recetaHogar);
            $recetaHogar->setHogar($this);
        }

        return $this;
    }

    public function removeRecetaHogar(RecetaHogar $recetaHogar): static
    {
        if ($this->recetaHogars->removeElement($recetaHogar)) {
            // set the owning side to null (unless already changed)
            if ($recetaHogar->getHogar() === $this) {
                $recetaHogar->setHogar(null);
            }
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
            $listaCompra->setHogar($this);
        }

        return $this;
    }

    public function removeListaCompra(ListaCompra $listaCompra): static
    {
        if ($this->listaCompras->removeElement($listaCompra)) {
            // set the owning side to null (unless already changed)
            if ($listaCompra->getHogar() === $this) {
                $listaCompra->setHogar(null);
            }
        }

        return $this;
    }
}
