<?php include 'includes/header.php';

//Conocer l extension de un sting
$nombreCliente="         Juan Pablo              ";
echo (strlen($nombreCliente));
var_dump($nombreCliente);
//Elmina el ESPACIO
echo "<br>";
$texto = trim($nombreCliente);
echo strlen($texto);

//Convertirlo a mayusculas
echo "<br>";
echo strtoupper($nombreCliente);

echo "<br>";
echo strtolower($nombreCliente);

$mail1="Correo@correo.Com";
$mail2="correo@correo.com";

/*Una validacion en el caso de correos electronicos*/
echo "<br>";
var_dump($mail1==$mail2);
var_dump(strtolower($mail1)==strtolower($mail2));

//Remplazar una variable
echo "<br>";
echo str_replace('Juan','Jose',$nombreCliente);//Devuelve una cadena con lo remplazado
echo "<br>";

//Revisar si un String existe
echo strrpos($nombreCliente,'Jose');
echo "<br>";
echo strrpos($nombreCliente,'Juan');
echo "<br>";
$tipoCliente="Premium";
echo "El Cliente ".$nombreCliente ." es ".$tipoCliente;
echo "<br>";
echo "El cliente {$nombreCliente} es {$tipoCliente}";




include 'includes/footer.php';