<?php include 'includes/header.php';

$variable="Soy una variable<br>";
$_variable2="Nombre de la variabe valido<br>";
echo $variable;
var_dump($_variable2);
define('constante','El valor de la constante<br>');
echo constante;/*No necesitamos el signo de dolar para imprimir constantes*/


include 'includes/footer.php';