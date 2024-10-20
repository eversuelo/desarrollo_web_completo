<?php
require '../includes/app.php';
estaAutenticado();
use App\Propiedad;
//Implementar un metodo para obtener todas la s propiedades
$propiedades=Propiedad::all();



if($_SERVER['REQUEST_METHOD']==="POST"){
    // echo "<pre>";
    // echo var_dump($_POST);
    // echo "</pre>";
    $id=$_POST['id'];
    $id=filter_var($id,FILTER_VALIDATE_INT);
    if($id){
        //Elimina el archivo
        $query="SELECT imagen From propiedades WHERE id=${id} ";
        $resultado=mysqli_query($db,$query);
        $propiedad=mysqli_fetch_assoc($resultado);
       
        unlink('../imagenes/'.$propiedad['imagen'].".jpg");
     
        //Elimina la propiedad
        $query="DELETE FROM propiedades WHERE id=${id}";
        $resultado=mysqli_query($db,$query);
        if($resultado){
            header('location: /admin?resultado=3');
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
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Propiedad Creada Correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Propiedad Actualizada Correctamente</p>
        <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito">Propiedad Borrada Correctamente</p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class=" boton boton-verde">Nueva Propiedad</a>
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
            <?php foreach($propiedades as $propiedad) : ?>
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
                        <form action=""method="POST" class="w-100">
                        <input type="hidden"
                        name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="submit" href="#" value="eliminar"class="boton-rojo-block">
                        </form>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</main>
<?php
//Cerrar la conexion
mysqli_close($db);
incluirTemplates('footer');
?>