<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicio Sesion con tus datos</p>
<?php
include_once __DIR__ . "/../templates/alertas.php";    ?>   
<form  class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Tu Email" required>
    </div>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Tu Contraseña" required>
    </div>
    <input type="submit" class="boton" value="Iniciar Sesión"> 

</form>
<div class="acciones">
    <a href="/crear-cuenta">Crear Cuenta</a>
    <a href="/olvide">Olvide mi Contraseña</a>
</div>