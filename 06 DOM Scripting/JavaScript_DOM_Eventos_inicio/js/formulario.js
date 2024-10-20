/**********************
 * Eventos de los Inputs y Textarea
 *  */
const datos = {
    nombre: '',
    email: '',
    mensaje: ''
}

window.addEventListener('load', iniciarApp);
function iniciarApp() {

    const nombre = document.querySelector('#nombre');
    const email = document.querySelector('#email');
    const mensaje = document.querySelector('#mensaje');
    const formulario = document.querySelector('.formulario');

    nombre.addEventListener('input', leerTexto);
    email.addEventListener('input', leerTexto);
    mensaje.addEventListener('input', leerTexto);
    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        //Validar el formulario
        const { nombre, email, mensaje } = datos;
        if (nombre === '' || email === '' || mensaje === '') {
            mostrarAlerta('Todos los campos son obligatorios', true);
            return; //Corta la ejecución del código
        }
        //Crear la alerta de que se envió correctamente
        mostrarAlerta('Mensaje enviado correctamente');
    });

}
function mostrarAlerta(mensaje, error = null) {
    const alerta = document.createElement('P');
    alerta.textContent = mensaje;
    if (error) {
        alerta.classList.add('error');
    } else {

        alerta.classList.add('correcto');
    }
    formulario.appendChild(alerta);
    //Desaparezca después de 5 segundos
    setTimeout(() => {
        alerta.remove();
    }, 5000);
}
//console.log(datos);
function leerTexto(e) {
    console.log(e.target.value);
    datos[e.target.id] = e.target.value;
    console.log(datos);
}