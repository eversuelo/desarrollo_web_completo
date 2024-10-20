<?php
require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$propiedad =new Propiedad();
//Consultar para obtener los vendedores
$vendedores=Vendedor::all();
//Arreglo con mensajes d errores
$errores = Propiedad::getErrores();


//Ejecutar el codigo depsues de que el ususario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //debuguear($_FILES);
    /*Crea una nueva instancia*/
    $propiedad = new Propiedad($_POST['propiedad']);

    //Subida de Archivos
    $carpetaImagenes = '../../imagenes/';

  

    //Generar un nombre unico
    $nombreImagen = md5(uniqid(rand(), true))."jpg";
    //Setear la Imagen
    //Realiza un reize a la mage con intevention7
  
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
        echo"Hay Imagen";
    }



    $errores = $propiedad->validar();

    
    if (empty($errores)) {
        
        //Crear la carpeta para subir imagenes
        if(!is_dir(CARPETA_IMAGENES)){
            echo "CREANDO LA cARPETA";
            mkdir(CARPETA_IMAGENES);
        }
        //Guarda la Imagen En el Servidor
        $image->save($carpetaImagenes . $nombreImagen);
        //gUARDA LA bASE DE dATOS
        $propiedad->setDB($db);
        $propiedad->guardar();
     
    }
}

incluirTemplates('header');
?>
<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin/index.php" class=" boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <p>
                <?php echo $error ?>
            </p>
        </div>
    <?php endforeach; ?>


    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
       <?php include '../../includes/templates/formulario_propiedades.php';?>
        <input type="submit" class="boton boton-amarillo" value="Crear Propiedad">
    </form>
</main>
<?php
incluirTemplates('footer');
?>