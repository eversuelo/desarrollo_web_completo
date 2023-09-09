<?php

declare(strict_types=1);
include 'includes/header.php';

//dEFINIR UNA CLASE PHP 8
class Producto
{
    //Public- se puede acceder y modificar en cualquier lugar(clase y Objeto)
    //Protected- se puede acceder unicamente desde  la clase
    //private solo miembros de la misma clase pueden acceder a el
    //public function __construct(protected string $nombre, public int $precio, public  bool $disponible)
    protected string $nombre;
    public int $precio;
    public  bool $disponible;
    public function __construct(string $nombre, int $precio,  bool $disponible)
    {
        $this->nombre=$nombre;
        $this->precio=$precio;
        $this->disponible=$disponible;

    }
    public function mostrarProducto()
    {
        echo "El producto e " . $this->nombre . " y su precio es de: " . $this->precio;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre(string $nombre)
    {
        $this->nombre=$nombre;
    }
}
$producto = new Producto('Tablet', 200, true);
$producto->setNombre("Wade ");
echo $producto->getNombre();
// echo "<pre>";
// var_dump($producto);
// echo "</pre>";
$producto2 = new Producto("Monitor Curvo", 300, true);
echo $producto2->getNombre();
// echo "<pre>";
// var_dump($producto2);
// echo "</pre>";

include 'includes/footer.php';
