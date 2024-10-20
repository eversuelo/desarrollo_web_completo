<?php

function conectarDB():mysqli{
    $db=new mysqli('localhost:3499',"root",'admin','bienes_raices');
    $db->set_charset('utf8');
    if(!$db){
        echo "nO Se conecto la base de datos <br>";
        exit;

    }
    return $db;
}