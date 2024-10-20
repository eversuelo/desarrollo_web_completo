document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    // console.log(mobileMenu);
    mobileMenu.addEventListener('click', navegacionResposive);
    //Muestra campos Condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"');
    console.log(metodoContacto);
    for (let i = 0; i < metodoContacto.length; i++) {
        metodoContacto[i].addEventListener('click', mostrarMetodosContacto);

    }

}
function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');
    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `<label for= "telefono" > Telefono</label>
            <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]" required>
            <p>elija la fecha y la hora para la llamada</p>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha"name="contacto[fecha]">
            <label for="hora">Hora:</label>
            <input type="time"id="hora" min="9:00" max="18:00"name="contacto[hora]">    
            `;


    } else if (e.target.value === 'email') {
        contactoDiv.innerHTML = `<label for="email">Email</label>
<input type="email" placeholder="Tu Email" id="email" name="contacto[email]"required>
    `;
    }
}
function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');

    });
}

function navegacionResposive() {
    const navegacion = document.querySelector('.navegacion');

    //  navegacion.classList.toggle('mostrar');//Es la abreviacion del if, hace lo mismo
    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }

}