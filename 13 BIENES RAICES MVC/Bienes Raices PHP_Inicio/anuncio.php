<?php

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: /');
}
require 'includes/app.php';
$db = conectarDB();
//Consultar
$query = "SELECT * FROM propiedades WHERE id=${id}";
//obtener resultado
$resultado = mysqli_query($db, $query);
$propiedad = mysqli_fetch_assoc($resultado);
if (!$resultado->num_rows) {
    header('Location : /');
}

incluirTemplates('header');
?>
<main class="contenedor contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>
    <picture>

        <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Casa en Venta" loading="lazy">
    </picture>
    <div class="resumen-propiedad">
        <p class="precio">
            <?php echo $propiedad['precio']; ?>
        </p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p> <?php echo $propiedad['wc']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono Estacionamiento">
                <p> <?php echo $propiedad['estacionamiento']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p> <?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>
        <p> <?php echo $propiedad['descripcion']; ?></p>
    </div>
</main>
<?php
mysqli_close($db);
incluirTemplates('footer');
?>