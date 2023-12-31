<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Restablece tu password escribiendo tu email a continuación</p>
<?php include_once __DIR__ . "/../templates/alertas.php";    ?> 

<form action="/olvide" method="POST" class="formulario">
    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Tu email">
    </div>
    <input type="submit" class="boton" value="Enviar Instrucciones">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una Cuenta?</a>
    <a href="/crear-cuenta">Crear Cuenta</a>
</div>