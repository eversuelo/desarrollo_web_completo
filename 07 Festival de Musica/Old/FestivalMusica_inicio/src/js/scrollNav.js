/*Esta funcion se encarga de deslizar lentamente el nav hasta el id indicado*/
function scrollNav() {
    const enlaces = document.querySelectorAll('.navegacion-principal a');

    enlaces.forEach(function(enlace) {
        enlace.addEventListener('click', function(e) {
            e.preventDefault();
            const seccion = document.querySelector(e.target.attributes.href.value);
            seccion.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
}
/* Esta funcion se encarga de colocar la navegacion fija despues de recorre*/

function navegacionFija() {
    const barra = document.querySelector('.header');
    //Registrar el Intesection OBserver
    const observer = new IntersectionObserver(function(entries) {
        console.log(entries[0])
        if (entries[0].isIntersecting) {
            barra.classList.remove('fixed')
        } else {
            barra.classList.add('fixed');
        }
    });
    //Elemento a Observar
    observer.observe(document.querySelector('.sobre-festival'));
}