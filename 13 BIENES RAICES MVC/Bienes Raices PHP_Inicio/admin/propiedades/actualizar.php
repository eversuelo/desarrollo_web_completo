<?php
require '../../includes/funciones.php';
$auth=estaAutenticado();
if(!$auth){
    header('Location: /login.php');
}
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

require '../../includes/config/database.php';
$db = conectarDB();
//Obtener los datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id={$id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);


//Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);
//Arreglo con mensajes d errores
$errores = [];
$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];;
$imagen = $propiedad['imagen'];;
$descripcion = $propiedad['descripcion'];;
$nombreImagen = $propiedad['imagen'];
$imagen;
$habitaciones = $propiedad['habitaciones'];;
$wc = $propiedad['wc'];;
$estacionamiento = $propiedad['estacionamiento'];;
$vendedorId = $propiedad['vendedorId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Sanitizar



    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $imagen = $_FILES['imagen'];
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');
    if (empty($titulo)) {
        $errores[] = "Debes de añadir un titulo";
    }
    if (empty($precio)) {
        $errores[] = "Debes de añadir un precio";
    }
    if (strlen($descripcion) < 30) {
        $errores[] = "Debes de añadir un descripcion con almenos 30 caracteres";
    }
    if (empty($habitaciones)) {
        $errores[] = "Debes de añadir un numero de habitaciones";
    }
    if (empty($wc)) {
        $errores[] = "Debes de añadir un numero de baños";
    }
    if (empty($estacionamiento)) {
        $errores[] = "Debes de añadir un numero de estacionamiento";
    }
    if (empty($vendedorId)) {
        $errores[] = "Debes de añadir un vendedor";
    }

    //Validar por tamaño (100 Kb maximo)
    $medida = 1000 * 100;
    if ($imagen['size'] > $medida) {
        $errores[] = "La imagen excede el limite";
    }
    // echo "<pre>";
    // echo var_dump($_POST);
    // echo "</pre>";

    // exit;

    if (empty($errores)) {
        //Subida de Archivos
        $carpetaImagenes = '../../imagenes/';
        if($imagen['name']){
            //Eliminar la imagen previa
            unlink($carpetaImagenes . $propiedad['imagen'].".jpg");
            
        //Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(), true));
        //Subir la imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen . ".jpg");
        }else{
            $nombreImagen=$propiedad['imagen'];
        }

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }


        //Insetar en la base de datos
        $query = "UPDATE propiedades SET titulo='${titulo}',precio='${precio}',imagen='${nombreImagen}', descripcion='${descripcion}',habitaciones=${habitaciones},wc=${wc},estacionamiento=${estacionamiento},vendedorId=${vendedorId} WHERE id=${id}";
        
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            //echo "Insertado Correctamente <br>";
            header('Location: /admin?resultado=2');
        } else {
            //  echo "ERROR IncCorrectamente <br>";
        }
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
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" placeholder="Precio Propiedad" min="1" max="100000000" value="<?php echo $precio ?>">

            <label for="imagen">Imagen</label>
            <input name="imagen" type="file" id="imagen" accept="image/jpeg, image/png">
            <img src="/imagenes/<?php echo $imagen . ".jpg"; ?>" alt="Imagen Propiedad" class="imagen-small">

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
            <select name="vendedor" id="vendedor" value="<?php echo $vendedorId ?>">
                <!--option value="" disabled="disabled" selected="selected">Seleccionar</option-->
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                <?php endwhile; ?>

            </select>
        </fieldset>
        <input type="submit" class="boton boton-amarillo" value="Actualizar Propiedad">
    </form>
</main>
<?php
incluirTemplates('footer');
?>