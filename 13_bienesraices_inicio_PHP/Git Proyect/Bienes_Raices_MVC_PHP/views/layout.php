<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
if (!isset($inicio)) {
    $inicio = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>
    <header class="header  <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor ">
            <div class="barra">
                <a href="/index.php">
                    <img src="/build/img/logo.svg" alt="">
                </a>
                <div class="mobile-menu">
                    <img src="build/img/barras.svg" alt="">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="dark-mode">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="/logout">Cerrar Sesion</a>
                        <?php endif; ?>

                    </nav>
                </div>
            </div>
            <?php
            if ($inicio) {
                echo "<h1 class='h1-venta'>Venta de Casas y Departamentos Exclusivos de Lujo</h1>";
            }
            ?>


        </div>
    </header>
    <?php echo $contenido; ?>
    <footer class="footer seccion">
        <div class="contenedor contenido-footer">

            <nav class="navegacion">
                <a href="/nosotros.php">Nosotros</a>
                <a href="/anuncios.php">Anuncios</a>
                <a href="/blog.php">Blog</a>
                <a href="/contacto.php">Contacto</a>
            </nav>

        </div>
        <p class="copyright">Todos los Derechos Reservados <?php echo date('Y'); ?> &copy; </p>
    </footer>
    <script src="../build/js/bundle.min.js"></script>
</body>

</html>