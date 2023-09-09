<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';
estaAutenticado();
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}
$db = conectarDB();
//Obtener los datos de la propiedad
$propiedad = Propiedad::find($id);



//Consultar para obtener los vendedores
$vendedores = Vendedor::all();

//Arreglo con mensajes d errores
$errores = Propiedad::getErrores();
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

incluirTemplates('header');
?>
<main class="contenedor seccion">
    <h1>Actualizar</h1>
    <a href="/admin/index.php" class=" boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <p>
                <?php echo $error ?>
            </p>
        </div>
    <?php endforeach; ?>


    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" class="boton boton-amarillo" value="Actualizar Propiedad">
    </form>
</main>
<?php
incluirTemplates('footer');
?>