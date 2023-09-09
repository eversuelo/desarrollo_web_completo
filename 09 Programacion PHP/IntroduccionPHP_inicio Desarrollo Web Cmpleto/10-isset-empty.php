<?php include 'includes/header.php';
$clientes=[];
$clientes1=array();
$clientes3=array('Pedro','Juan','Karen');
$cliente=[
    'nombre'=>'Juan',
    'saldo'=>200
];

//Empty rEVISA SI UN AARREGLO esta vacio devuelve true si esta vacio
var_dump(empty($clientes));
echo "<br>";
var_dump(empty($clientes3));
echo "<br>";
//Isset- Revisa si un arreglo esta creado o una propiedad esta definida
var_dump(isset($clientes));
echo "<br>";
var_dump(isset($clientes3));
echo "<br>";
//ISSET - permite revisar si una propiedad de un arreglo asociativo existe
var_dump(isset($cliente['nombre']));
echo "<br>";
var_dump(isset($cliente['credito']));
echo "<br>";

include 'includes/footer.php';