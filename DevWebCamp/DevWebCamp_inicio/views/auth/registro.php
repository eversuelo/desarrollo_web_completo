<main class="auth">
    <h2 class="auth__heading"> <?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en DevWebCamp</p>



    <form class="formulario" action="">
        <div class="formulario__campo">
            <label class="formulario__label" for="nombre">Nombre</label>
            <input type="nombre" class="formulario__input" placeholder="Tu nombre" id="nombre" name="email">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="apellido">Apellido</label>
            <input type="apellido" class="formulario__input" placeholder="Tu apellido" id="apellido" name="email">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="email">Email</label>
            <input type="email" class="formulario__input" placeholder="Tu Email" id="email" name="email">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="password">Password</label>
            <input type="password" class="formulario__input" placeholder="Tu Password" id="password" name="password">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="password2">Repetir Password</label>
            <input type="password2" class="formulario__input" placeholder="Tu Password" id="password2" name="password2">
        </div>
        <input type="submit" class="formulario__submit" value="Crear Cuenta">
    </form>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a href="/olvide" class="acciones__enlace">Olvide mi contraseña-</a>
    </div>

</main>