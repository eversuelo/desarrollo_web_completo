<?php
$conn=new mysqli('localhost:3499','root','admin','uptask');

/*Esto Sirve para dejar en la base de datos si hay un error*/
if($conn->connect_error){
    echo $conn->connect_error;
}
$conn->set_charset('utf8');
?>