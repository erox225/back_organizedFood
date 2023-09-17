<?php

namespace App\Entity;

use App\Repository\ListaCompraRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListaCompraRepository::class)]
class ListaCompra
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $estadoProducto = null;

    #[ORM\ManyToOne(inversedBy: 'listaCompras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Producto $Producto = null;

    #[ORM\ManyToOne(inversedBy: 'listaCompras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Receta $Receta = null;

    #[ORM\ManyToOne(inversedBy: 'listaCompras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hogar $hogar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstadoProducto(): ?int
    {
        return $this->estadoProducto;
    }

    public function setEstadoProducto(int $estadoProducto): static
    {
        $this->estadoProducto = $estadoProducto;

        return $this;
    }

    public function getProducto(): ?Producto
    {
        return $this->Producto;
    }

    public function setProducto(?Producto $Producto): static
    {
        $this->Producto = $Producto;

        return $this;
    }

    public function getReceta(): ?Receta
    {
        return $this->Receta;
    }

    public function setReceta(?Receta $Receta): static
    {
        $this->Receta = $Receta;

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
