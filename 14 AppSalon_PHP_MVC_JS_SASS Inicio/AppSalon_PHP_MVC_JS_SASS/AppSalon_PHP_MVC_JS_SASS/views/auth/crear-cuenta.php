<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>
<?php
include_once __DIR__ . "/../templates/alertas.php";    ?> 
<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu NOMBRE" value="<?php echo s($usuario->nombre); ?>">
    </div>
    <div class="campo">
        <label for="apellido">apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" value="<?php echo s($usuario->apellido); ?>">
    </div>
    <div class="campo">
        <label for="telefono">Telefono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Tu telefono" value="<?php echo s($usuario->telefono); ?>">
    </div>
    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Tu email" value="<?php echo s($usuario->email); ?>">
    </div>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Tu password">
    </div>
    <input type="submit" value="Crear Cuneta" class="boton">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una Cuenta?</a>
    <a href="/olvide">Olvide mi Contraseña</a>
</div>