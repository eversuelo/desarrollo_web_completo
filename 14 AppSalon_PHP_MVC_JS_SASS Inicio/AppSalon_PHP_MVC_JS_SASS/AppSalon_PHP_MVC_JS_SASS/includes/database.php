<?php

$db = mysqli_connect('localhost:3306', 'root', 'root', 'app_salon_mvc');

$db->set_charset("utf8");
if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
