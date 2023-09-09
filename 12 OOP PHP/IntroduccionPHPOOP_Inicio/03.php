<?php include 'includes/header.php';
class Producto
{
    public $imagen;
    public static $imagenPlaceholder="Imagen.jpg";
    public string $nombre;
    public int $precio;
    public bool $disponible;

    //Public- se puede acceder y modificar en cualquier lugar(clase y Objeto)
    //Protected- se puede acceder unicamente desde  la clase
    //private solo miembros de la misma clase pueden acceder a el
function __construct( string $nombre, int $precio,  bool $disponible,  $imagen)
    {
        $this->nombre=$nombre;
        $this->precio=$precio;
        $this->disponible=$disponible;
        if($imagen){
            self::$imagenPlaceholder=$imagen;
        }
    }
    public static function obtenerImagenProducto(){
        return self::$imagenPlaceholder;
    }
    public static function obtenerProducto(){
        echo "Obteniendo datos del Producto";
    }
     public  function mostrarProducto()
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
$producto = new Producto('Tablet', 200, true,null);
$producto->setNombre("Wade ");
echo $producto->obtenerImagenProducto();
 echo "<pre>";
 var_dump($producto);
 echo "</pre>";
$producto2 = new Producto("Monitor Curvo", 300, true,"monitorCurvo.jpg");
echo $producto2->obtenerImagenProducto();
 echo "<pre>";
 var_dump($producto2);
 echo "</pre>";

echo Producto::obtenerImagenProducto();
include 'includes/footer.php';