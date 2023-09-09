<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu password a continuación</p>

<?php include_once __DIR__ . "/../templates/alertas.php";    ?> 
<?php if($error) return null;?>
<form  method="POST" class="formulario">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="">
    </div>
    <input type="submit" class="boton" value="Restablecer Password">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una Cuenta?</a>
    <a href="/crear-cuenta">Crear Cuenta</a>
</div>