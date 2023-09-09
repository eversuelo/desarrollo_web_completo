<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));
        if ($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>

    <?php }
    } ?>
    <a href="/propiedades/crear" class=" boton boton-verde">Nueva Propiedad</a>
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
                        <form  method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" href="#" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/vendedores/crear" class=" boton boton-verde">Nuevo Vendedor</a>
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
                        <form  method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" href="#" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>