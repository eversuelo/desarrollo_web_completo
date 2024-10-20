<?php

namespace Controllers;

require_once '../includes/app.php';

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class VendedorController
{

    public static function crear(Router $router)
    {
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            //Validar que no haya campos vacios
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }
        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores

        ]);
    }
    public static function actualizar(Router $router)
    {
       $id=validarORedireccionarID('/admin');
        //Obtener los datos del vendedor
        $vendedor = Vendedor::find($id);

        //Arreglo con mensaje de errores 
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Asignar los atributos
            $args = $_POST['vendedor'];

            // Sincronizar objeto en memoria con lo que el usuario escribió
            $vendedor->sincronizar($args);

            // Validación
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores

        ]);
    }
    public static function eliminar(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                     $resultado=$vendedor->eliminar();
                    header('Location:/admin?'.$resultado);
                }
            }
        }
    }
}
