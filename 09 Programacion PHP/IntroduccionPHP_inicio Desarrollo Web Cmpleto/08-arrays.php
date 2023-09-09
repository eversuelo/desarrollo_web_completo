<?php include 'includes/header.php';
$carrito=['tablet','television','computadora'];
//Util para ver los contenidos de un array

echo "<pre>";
var_dump($carrito);
echo "<pre>";

//Acceder a un elemento del array
echo $carrito[1];
$carrito[3]='Nuevo Producto';
//AñADR un elemento al final
array_push($carrito,'Audifonos');
array_unshift($carrito,'Algo al inicio');
echo "<pre>";
var_dump($carrito);
echo "<pre>";
$clientes=array('Cliente1','Cliente 2','Cliente 3');
echo "<pre>";
var_dump($clientes);
echo "<pre>";
include 'includes/footer.php';