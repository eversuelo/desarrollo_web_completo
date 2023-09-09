<?php
/*Esta funcion retorna en que pagina se esta ejecutando*/
function obtenerPaginaActual()
{
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    return $pagina;
}
/* Obtener todos los proyectos */
function obtenerProyectos()
{
    include 'conexion.php';
    try {
        return $conn->query('SELECT id, nombre FROM proyectos');
    } catch (Exception $e) {
        echo "Error! : " . $e->getMessage();
        return false;
    }
}
// Obtener el nombre del Proyecto
function obtenerNombreProyecto($id = null)
{
    include 'conexion.php';
    try {
        return $conn->query("SELECT nombre FROM proyectos WHERE id= {$id}");
    } catch (Exception $e) {
        echo "Error! : " . $e->getMessage();
        return false;
    }
}
// Obtener las clases del Proyecto 
function obtenerTareasProyecto($id = null) {
    include 'conexion.php';
    try {
        return $conn->query("SELECT id, nombre, estado FROM tareas WHERE id_proyecto = {$id}");
    } catch(Exception $e) {
        echo "Error! : " . $e->getMessage();
        return false;
    }
}
