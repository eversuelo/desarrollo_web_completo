<?php
require '../includes/app.php';
estaAutenticado();

use App\Propiedad;
use App\Vendedor;

//Implementar un metodo para obtener todas la s propiedades
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // echo "<pre>";
    // echo var_dump($_POST);
    // echo "</pre>";
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) {
        $tipo = $_POST['tipo'];
        if (validarTipoContenido($tipo)) {
            if ($tipo === 'propiedad') {
                $propiedad = Propiedad::find($id);
                $propiedad->eliminar();
                header('Location:/admin/');
            } else if ($tipo === 'vendedor') {
                $vendedor = Vendedor::find($id);
                $vendedor->eliminar();
                header('Location:/admin/');
            }
        }
    }
}


incluirTemplates('header');
$resultado = "";
if (isset($_GET['resultado'])) {
    //Muestra mensaje Condicional
    $resultado = $_GET['resultado'] ?? null;
}

?>
<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php $mensaje = mostrarNotificacion(intval($resultado));
    if ($mensaje) { ?>
    <p class="alerta exito"><?php echo s($mensaje);?></p>

    <?php } ?>
    <a href="/admin/propiedades/crear.php" class=" boton boton-verde">Nueva Propiedad</a>
    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!--Mostrar los Resutados-->
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td>
                        <p><?php echo $propiedad->id; ?></p>
                    </td>
                    <td>
                        <p><?php echo $propiedad->titulo; ?></p>
                    </td>

                    <td><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="IMAGEN"></td>
                    <td>
                        <p class="precio">$<?php echo $propiedad->precio; ?></p>
                    </td>
                    <td>
                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" href="#" value="eliminar" class="boton-rojo-block">
                        </form>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/admin/vendedores/crear.php" class=" boton boton-verde">Nuevo Vendedor</a>
    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!--Mostrar los Resutados-->
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td>
                        <p><?php echo $vendedor->id; ?></p>
                    </td>
                    <td>
                        <p><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></p>
                    </td>


                    <td>
                        <p class="precio"><?php echo $vendedor->telefono; ?></p>
                    </td>
                    <td>
                        <form action="" method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" href="#" value="eliminar" class="boton-rojo-block">
                        </form>
                        <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php
//Cerrar la conexion
incluirTemplates('footer');
?>