<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="desripcion-pagina text-center">Elige tus servicios y coloca tus datos a continuacion</p>
<?php include_once __DIR__.'/../templates/barra.php' ?>
<div id="app">
    <nav class="tabs">
        <button type="button" data-paso="1" class="actual">Servicios</button>
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>
    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus sercvicios a continuacion</p>
        <div id="servicios" class="listado-servicios">

        </div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Coloca tus Datos y Fecha de Cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre"> Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo $nombre; ?>" disabled>
            </div>
            <div class="campo">
                <label for="fecha"> fecha</label>
                <input type="date" id="fecha" name="fecha" min="<?php echo date('Y-m-d')?>">
            </div>

            <div class="campo">
                <label for="hora"> hora</label>
                <input type="time" id="hora" name="hora">
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>
    <div id="paso-3" class="contenido-resumen seccion">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea Correcta</p>
        <div id="servicios" class="listado-servicios">

        </div>
    </div>
    <div class="paginacion">
    <button id="anterior" class="boton">&laquo; Anterior</button>
    <button id="siguiente" class="boton">Siguiente &raquo; </button>
    </div>
</div>
<?php 
    $script="<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script><script src='build/js/app.js'></script>";
?>