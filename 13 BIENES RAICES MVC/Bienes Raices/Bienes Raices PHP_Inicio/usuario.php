<?php
//Importar la Conexio 
require 'includes/app.php';
$db=conectarDB();
//cREAR UN EMAIL Y PASSWORD
$email='correo@correo.com';
$password="123456";
$passwordHash=password_hash($password,PASSWORD_BCRYPT);
//Query para crear el usuario
$query="INSERT INTO usuarios (email,password) VALUES ('${email}','${passwordHash}');";
//echo $query;
//exit;
mysqli_query($db,$query);
//Agregarlo a la base de datos
