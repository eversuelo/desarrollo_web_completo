<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>
    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis enim aperiam veritatis, voluptas quisquam nam incidunt. Sint, magni quibusdam. Nobis nostrum magni quod iusto. Culpa autem veritatis enim nobis numquam.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis enim aperiam veritatis, voluptas quisquam nam incidunt. Sint, magni quibusdam. Nobis nostrum magni quod iusto. Culpa autem veritatis enim nobis numquam.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
            <h3>A Tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis enim aperiam veritatis, voluptas quisquam nam incidunt. Sint, magni quibusdam. Nobis nostrum magni quod iusto. Culpa autem veritatis enim nobis numquam.</p>
        </div>
    </div>
</main>
<section class="seccion contenedor">
    <h2>Casas y Depas en Venta</h2>
    <?php 
    $limite=3;
    include 'listado.php'; ?>

    <div class="alinear-derecha">
        <a href="/propiedades" class="boton boton-verde ">ver Todas</a>
    </div>
</section>
<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad.</p>
    <a href="/contacto" class="boton-amarillo">Contactanos</a>
</section>
<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro blog</h3>
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
                    <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por <span>Admin</span></p>
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
                    <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por <span>Admin</span></p>
                    <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles colores para darle vida a tu espacio</p>
                </a>

            </div>
        </article>
    </section>
    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comporto de una excelente forma, muy buena atencion y la casa que me ofrecieron cumple con las expectativas.
            </blockquote>
            <p>Juan de la Torre</p>
        </div>
    </section>
</div>