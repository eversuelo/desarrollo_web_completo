<?php 
    require '../../includes/app.php';
    use App\Vendedor;
    estaAutenticado();

    //Validar que sea un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id)
        header('Location: /admin');

    //Obtener los datos del vendedor
    $vendedor = Vendedor::find($id);

    //Arreglo con mensaje de errores 
    $errores = Vendedor::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
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

    incluirTemplate ('header'); 
    ?>

    <main class="contenedor seccion">
        <h1>Actualizar vendedor(a)</h1>

        <a href="/admin" class="boton boton-verde">&larr; Volver</a>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php';?>
            <div class="alinear-derecha">
                <input type="submit" value="Guardar Cambios" class="boton boton-verde">
            </div>
        </form>
    </main>

<?php incluirTemplate ('footer'); ?>