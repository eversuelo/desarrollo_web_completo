<?php
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();


$db = conectarDB();

//Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);
//Arreglo con mensajes d errores
$errores = Propiedad::getErrores();

$titulo = '';
$precio = '';
$imagen = '';
$descripcion = '';
$imagen;
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';
//Ejecutar el codigo depsues de que el ususario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /*Crea una nueva instancia*/
    $propiedad = new Propiedad($_POST);

    //Subida de Archivos
    $carpetaImagenes = '../../imagenes/';


    //Generar un nombre unico
    $nombreImagen = md5(uniqid(rand(), true))."jpg";
    //Setear la Imagen
    //Realiza un reize a la mage con intevention7
    echo "<pre>";
    var_dump($_FILES);
    echo "</pre>";
    if ($_FILES['imagen']['tmp_name']) {
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
        echo"Hay Imagen";
    }



    $errores = $propiedad->validar();

    
    if (empty($errores)) {
     
        //Crear la carpeta para subir imagenes
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }
        //Guarda la Imagen En el Servidor
        $image->save($carpetaImagenes . $nombreImagen);
        //gUARDA LA bASE DE dATOS
        $resultado=$propiedad->guardar();
        //mENSAJE De Exito
        if ($resultado) {
            //echo "Insertado Correctamente <br>";
            header('Location: /admin?resultado=1');
        } else {
            //  echo "ERROR IncCorrectamente <br>";
        }
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


    <form class="formulario" method="POST" action="/admin//propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" placeholder="Precio Propiedad" min="1" max="100000000" value="<?php echo $precio ?>">

            <label for="imagen">Imagen</label>
            <input name="imagen" type="file" id="imagen" accept="image/jpeg, image/png">


            <label for="descripcion">descripcion</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10" style="resize:none"><?php echo $descripcion ?></textarea>

        </fieldset>
        <fieldset>
            <legend>Informacion de Propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3 Habitaciones" min="1" max="100" value="<?php echo $habitaciones ?>">
            <label for="wc">Baños:</label>
            <input type="number" id="wc" placeholder="Ej: 3 baños" name="wc" min="1" max="100" value="<?php echo $wc ?>">
            <label for="estacionamiento:">Estacionamiento::</label>
            <input type="number" id="estacionamiento:" value="<?php echo $estacionamiento ?>" name="estacionamiento" placeholder="Ej: 3 estacionamiento:" min="1" max="100">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedorId" id="vendedor" value="<?php echo $vendedorId ?>">
                <!--option value="" disabled="disabled" selected="selected">Seleccionar</option-->
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                <?php endwhile; ?>

            </select>
        </fieldset>
        <input type="submit" class="boton boton-amarillo" value="Crear Propiedad">
    </form>
</main>
<?php
incluirTemplates('footer');
?>