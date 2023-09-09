<?php
$accion = $_POST['accion'];
$proyecto = $_POST['proyecto'];
if ($accion == 'crear') {
    //Importar la conexion

    try {
        include '../funciones/conexion.php';
        //Ralizar la consulta a la base de datos
        $stmt = $conn->prepare("INSERT INTO proyectos (nombre) VALUES ( ? )");
        $stmt->bind_param('s', $proyecto);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => $accion,
                'nombre_proyecto' => $proyecto
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error Lineas'

            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        //En caso de que haya un error
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);
}
