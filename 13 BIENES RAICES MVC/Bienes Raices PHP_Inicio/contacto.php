<?php
    require 'includes/app.php';

    incluirTemplates('header');
?>
    <main class="contenedor">
        <h1>Contacto</h1>
        <picture>

            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Sobre Contacto" loading="lazy">
        </picture>
        <h2>Llene el formulario de contacto</h2>
        <form action="" class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre">

                <label for="email">Email</label>
                <input type="email" placeholder="Tu Email" id="email">

                <label for="telefono">Telefono</label>
                <input type="tel" placeholder="Tu Telefono" id="telefono">

                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" cols="40" rows="10"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la Propiedad</legend>
                <label for="opciones"> Vende o Compra:</label>
                <select name="opciones" id="opciones">
                    <option value="" disabled selected>--Selecionar--</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>
                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" placeholder="Tu presupuesto" id="presupuesto" min="0">
            </fieldset>
            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser Contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input name="contacto" for="contacto" type="radio" value="telefono" id="contactar-telefono">
                    <label for="contactar-email">Email</label>
                    <input name="contacto" for="contacto" type="radio" value="email" id="contactar-email">
                </div>
                <p>Si eligion telefono,elija la fecha y la hora</p>
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">
                <label for="hora">Hora:</label>
                <input type="time" name="hora" id="hora" min="9:00" max="18:00">
            </fieldset>
            <input type="submit" class="boton-verde" value="Enviar">
        </form>
    </main>
    <?php
      incluirTemplates('footer');
?>