<main class="contenedor">
    <?php
    if ($mensaje) { ?>
        <p class="alerta exito"><?php echo $mensaje; ?></p>
    <?php
    }
    ?>
    <h1>Contacto</h1>
    <picture>

        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img src="build/img/destacada3.jpg" alt="Sobre Contacto" loading="lazy">
    </picture>
    <h2>Llene el formulario de contacto</h2>
    <form action="" class="formulario" method="POST">
        <fieldset>
            <legend>Informacion Personal</legend>
            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required>



            <label for="mensaje">Mensaje</label>
            <textarea name="contacto[mensaje]" id="mensaje" cols="40" rows="10" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion sobre la Propiedad</legend>
            <label for="opciones"> Vende o Compra:</label>
            <select name="contacto[tipo]" id="opciones" required>
                <option value="" disabled selected>--Selecionar--</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>
            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu presupuesto" id="presupuesto" min="0" name="contacto[precio]">
        </fieldset>
        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser Contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Telefono</label>
                <input for="contacto" type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>
                <label for="contactar-email">Email</label>
                <input for="contacto" type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
            </div>
            <div id="contacto">

            </div>

        </fieldset>
        <input type="submit" class="boton-verde" value="Enviar">
    </form>
</main>