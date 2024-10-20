<main class="auth">
    <h2 class="auth__heading"> <?php echo $titulo; ?></h2>
    <p class="auth__texto">Iniccia sesión en DevWebCamp</p>
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <form method="POST" class="formulario" action="">
        <div class="formulario__campo">
            <label class="formulario__label" for="email">Email</label>
            <input type="email" class="formulario__input" placeholder="Tu Email" id="email" name="email">
        </div>
        <div class="formulario__campo">
            <label class="formulario__label" for="password">Password</label>
            <input type="password" class="formulario__input" placeholder="Tu Password" id="password" name="password">
        </div>
        <input type="submit" class="formulario__submit" value="Iniciar Sesión">
    </form>
    <?php if (isset($alertas['exito'])) { ?>
        <div class=" acciones--centrar">
            <a href="/login" class="acciones__enlace"> Inicia Sesión</a>
        </div>
    <?php } ?>
</main>