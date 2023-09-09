<?php include 'includes/header.php';

$numero1=20;
$numero2=20;
$numero3=30;
$numero4="30";

var_dump($numero1> $numero2);
echo "<br>";
var_dump($numero1>= $numero2);
echo "<br>";
var_dump($numero1< $numero3);
echo "<br>";
var_dump($numero3== $numero4);
echo "<br>";
var_dump($numero3=== $numero4);//Estricto
echo "<br>";
//0 si son iguales -1 si izquierda es mayor 1 si derecha es mayor
var_dump($numero3 <=> $numero1);
echo "<br>";
var_dump($numero2 <=> $numero1);
echo "<br>";
var_dump($numero1 <=> $numero3);                            
echo "<br>";

include 'includes/footer.php';