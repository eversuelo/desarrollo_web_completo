<div class="contenedor restablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">
            Coloca tu Nuevo Password
        </p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <?php if($mostrar){ ?>
        <form  method="POST" class="formulario">
            <div class="campo">
                <label for="password">Password: </label>
                <input type="password" id="password" placeholder="Tu password" name="password">

            </div>
            <div class="campo">
                <label for="password2">Repetir<br>Password: </label>
                <input type="password" id="password2" placeholder="Tu password" name="password2">

            </div>
            <input type="submit" class="boton" value="Guardar Password">
        </form>
        <?php } ?>
        <div class="acciones">
            <a href="/crear">¿Aun no tienes una cuenta? Obten una</a>
            <a href="/">¿Ya tienes una cuenta? Inicia Sessión</a>
        </div>
    </div>
</div>