<?php
function obtenerServicios()
{
    try {
        //Importar una conexion
        require 'database.php';
        //Escribir el codigo SQL
        $db->set_charset("utf8");
        $consulta = "SELECT * FROM servicios";
        $consulta = mysqli_query($db, $consulta);

        //Arreglo Vacion
        $servicios = [];

        $i = 0;
        //Obtener los resultados
        while ($row = mysqli_fetch_assoc($consulta)) {
            $servicios[$i]['id'] = $row['id'];
            $servicios[$i]['nombre'] = $row['nombre'];
            $servicios[$i]['precio'] = $row['precio'];
            $i++;
        }
     

        return $servicios;
    } catch (\Throwable $th) {
        //Throw $th;
        var_dump($th);
    }
}
