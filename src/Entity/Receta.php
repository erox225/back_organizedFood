<?php

namespace App\Entity;

use App\Repository\RecetaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetaRepository::class)]
class Receta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaCreacion = null;

    #[ORM\ManyToMany(targetEntity: Usuario::class, mappedBy: 'Recetas')]
    private Collection $usuarios;

    #[ORM\ManyToMany(targetEntity: Producto::class, inversedBy: 'recetas')]
    private Collection $productos;

    #[ORM\OneToMany(mappedBy: 'receta', targetEntity: RecetaHogar::class, orphanRemoval: true)]
    private Collection $recetasHogar;

    #[ORM\OneToMany(mappedBy: 'Receta', targetEntity: ListaCompra::class, orphanRemoval: true)]
    private Collection $listaCompras;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
        $this->productos = new ArrayCollection();
        $this->listaCompras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): static
    {
        $this->Nombre = $Nombre;

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
            $usuario->addReceta($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): static
    {
        if ($this->usuarios->removeElement($usuario)) {
            $usuario->removeReceta($this);
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
     * @return Collection<int, RecetaHogar>
     */
    public function getRecetasHogar(): Collection
    {
        return $this->recetasHogar;
    }

    public function addRecetasHogar(RecetaHogar $recetasHogar): static
    {
        if (!$this->recetasHogar->contains($recetasHogar)) {
            $this->recetasHogar->add($recetasHogar);
            $recetasHogar->setReceta($this);
        }

        return $this;
    }

    public function removeRecetasHogar(RecetaHogar $recetasHogar): static
    {
        if ($this->recetasHogar->removeElement($recetasHogar)) {
            // set the owning side to null (unless already changed)
            if ($recetasHogar->getReceta() === $this) {
                $recetasHogar->setReceta(null);
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
            $listaCompra->setReceta($this);
        }

        return $this;
    }

    public function removeListaCompra(ListaCompra $listaCompra): static
    {
        if ($this->listaCompras->removeElement($listaCompra)) {
            // set the owning side to null (unless already changed)
            if ($listaCompra->getReceta() === $this) {
                $listaCompra->setReceta(null);
            }
        }

        return $this;
    }

}
