<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Tu cuenta DevWebCamp</p>

    <?php
    require_once __DIR__ . '/../templates/alertas.php';
    ?>
    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aun no tienes una cuenta? Obtener una</a>
        <a href="/olvide" class="acciones__enlace">Olvide mi contraseña-</a>
    </div>
</main>