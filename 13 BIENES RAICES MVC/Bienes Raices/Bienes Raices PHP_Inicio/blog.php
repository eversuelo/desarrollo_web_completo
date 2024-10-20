<?php
        require 'includes/funciones.php';

        incluirTemplates('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Nuestro Blog</h1>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="imge/webp">
                    <source srcset="build/img/blog1.jpg" type="imge/jpeg">
                    <img src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4> Terraza en el techo de tu casa</h4>
                    <p>Escrito el: <span>20/10/2021</span> por <span>Admin</span></p>
                    <p>Consejos para construir na Terraza en el techo de tu casa con los mejore materiales y ahorrando dinero.</p>
                </a>

            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="imge/webp">
                    <source srcset="build/img/blog2.jpg" type="imge/jpeg">
                    <img src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guia para la decoracion de tu hogar</h4>
                    <p>Escrito el: <span>20/10/2021</span> por <span>Admin</span></p>
                    <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles colores para darle vida a tu espacio</p>
                </a>

            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog3.webp" type="imge/webp">
                    <source srcset="build/img/blog3.jpg" type="imge/jpeg">
                    <img src="build/img/blog3.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4> Terraza en el techo de tu casa</h4>
                    <p>Escrito el: <span>20/10/2021</span> por <span>Admin</span></p>
                    <p>Consejos para construir na Terraza en el techo de tu casa con los mejore materiales y ahorrando dinero.</p>
                </a>

            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog4.webp" type="imge/webp">
                    <source srcset="build/img/blog4.jpg" type="imge/jpeg">
                    <img src="build/img/blog4.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guia para la decoracion de tu hogar</h4>
                    <p>Escrito el: <span>20/10/2021</span> por <span>Admin</span></p>
                    <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles colores para darle vida a tu espacio</p>
                </a>

            </div>
        </article>

    </main>
    <?php

        incluirTemplates('footer');
?>