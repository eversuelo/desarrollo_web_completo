<?php include 'includes/header.php';
require 'vendor/autoload.php';
// require 'clases/Clientes.php';
// require 'clas,es/Detalles.php';
use App\Clientes;
use App\Detalles;
function mi_autoload($clase){
    $partes=explode('\\',$clase);
    require __DIR__ . '/clases/'.$partes[1].".php";
}
spl_autoload_register('mi_autoload');

$detalles=new Detalles();
$clientes=new Clientes();
include 'includes/footer.php';