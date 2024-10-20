<?php

function conectarDB():mysqli{
    $db=new mysqli('localhost:3306',"root",'root','bienesraices_crud');
    $db->set_charset('utf8');
    if(!$db){
        echo "No Se conecto la base de datos <br>";
        exit;

    }
    //echo "Conexion con Exito";
     return $db; 
}