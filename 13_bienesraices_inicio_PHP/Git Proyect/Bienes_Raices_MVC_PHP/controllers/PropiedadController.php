<?php

namespace Controllers;

require_once '../includes/app.php';

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores=Vendedor::all();

        $resultado = $_GET['resultado'] ?? null;
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores'=>$vendedores
        ]);
    }
    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //debuguear($_FILES);
            /*Crea una nueva instancia*/
            $propiedad = new Propiedad($_POST['propiedad']);




            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //Setear la Imagen
            //Realiza un reize a la mage con intevention7

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
                echo "Hay Imagen";
            }



            $errores = $propiedad->validar();


            if (empty($errores)) {

                //Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    echo "CREANDO LA cARPETA";
                    mkdir(CARPETA_IMAGENES);
                }
                //Guarda la Imagen En el Servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                //gUARDA LA bASE DE dATOS
                $propiedad->setDB(conectarDB());
                $propiedad->guardar();
            }
        }
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validarORedireccionarID('/admin');
        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();
        //Metodo Post Para Acctualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);
            //debuguear($_FILES);
            $errores = $propiedad->validar();

            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //Subida de archivos
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
                echo "Hay Imagen";
            }
            if (empty($errores)) {
                //Almacenar la imagen
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
                //Insetar en la base de datos

            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
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
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                    header('Location:/admin?resultado=3');
                }
            }
        }
    }
}
