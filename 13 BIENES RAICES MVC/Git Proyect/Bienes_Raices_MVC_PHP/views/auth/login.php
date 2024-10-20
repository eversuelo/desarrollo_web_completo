<main class="contenedor">
    <h1>Iniciar Session</h1>
    <?php foreach ($errores as $error) : ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form method="POST" class="formulario contenido-centrado" action="/login">
        <fieldset>
            <legend>Email y Password</legend>


            <label for="email">email</label>
            <input type="email" name="email" id="email" placeholder="email Propiedad" required>

            <label for="password">Password</label>
            <input name="password" type="password" id="password" placeholder="Tu Password" required>

        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
    </form>
</main>