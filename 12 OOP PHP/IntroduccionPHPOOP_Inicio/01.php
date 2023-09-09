<?php 
declare(strict_types=1);
include 'includes/header.php';

//dEFINIR UNA CLASE
class Producto{
    public $nombre;
    public $precio;
    public $disponible;
    public function __construct(string $nombre, int $precio,bool $disponible){
        $this->nombre=$nombre;
        $this->precio=$precio;
        $this->disponible=$disponible;
    }
    public function mostrarProducto(){
        echo "El Producto es ".$this->nombre ." y su precio es de ".$this->precio;
    }
}
$producto=new Producto('Tablet',200,true);
$producto->mostrarProducto();
// $producto->nombre='Tablet';
// $producto->precio=200;
// $producto->disponible=false;
echo "<pre>";
var_dump($producto);
echo "</pre>";
$producto2=new Producto("Monitor Curvo",300,true);
$producto2->mostrarProducto();
// $producto2->nombre='Monito Curvo';
// $producto2->precio=300;
// $producto2->disponible=false;

echo "<pre>";
var_dump($producto2);
echo "</pre>";
include 'includes/footer.php';