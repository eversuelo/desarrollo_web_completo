<div class="contenedor olvide">
<?php include_once __DIR__ .'/../templates/nombre-sitio.php';?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">
           Recupera tu acceso a UpTask
        </p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <form action="/olvide" method="POST" class="formulario" novalidate>
            <div class="campo">
                <label for="email">Email:</label>
                    <input type="email" id="email" placeholder="Tu Email" name="email" >
                
            </div>
    
            <input type="submit" class="boton" value="Resetear Password">
        </form>
        <div class="acciones">
            <a href="/crear">¿Aun no tienes una cuenta? Obten una</a>
            <a href="/olvide">¿Olvidaste tu Password?</a>
        </div>
    </div>
</div>