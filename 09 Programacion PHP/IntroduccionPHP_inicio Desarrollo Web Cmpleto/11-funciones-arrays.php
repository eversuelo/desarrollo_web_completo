<?php include 'includes/header.php';
//in_array -buscar elementos en un arreglo
$carrito=['tablet','computadora','Television'];
var_dump( in_array("tablet",$carrito));
echo "<br>";
echo in_array("TABLET",$carrito);
echo" listo";

//Ordear elementos de un arreglo
$numeros=array(10,1,3,2,5,9);
sort($numeros);//De menor a mayor
rsort($numeros);
echo "<pre>";
var_dump($numeros);
echo "</pre>";

//Ordenaar Arreglo Asiciativo
$cliente=array(
    'saldo'=>200,
    'tipo'=>'Premium',
    'nombre'=>'Juan'
);
echo "<pre>";
var_dump($cliente);
echo "</pre>";
asort($cliente);
//Sort por asort orden alfabetico
echo "<pre>";
var_dump($cliente);
echo "</pre>";
//sort por ksort orden alfabetico
ksort($cliente); //Ordena por Llaves
echo "<pre>";
var_dump($cliente);
echo "</pre>";
//Ordena por orden alfabtico al reves las llaves
krsort($cliente); //Ordena por Llaves
echo "<pre>";
var_dump($cliente);
echo "</pre>";

include 'includes/footer.php';