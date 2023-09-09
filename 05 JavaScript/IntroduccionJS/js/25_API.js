'use strict'
//Si uieres seleccionar cosas de HTML utiliza document
const boton = document.querySelector('#boton');
console.log(boton);
boton.addEventListener('click', function() {
    Notification.requestPermission() //Primero se pide permiso
        .then(resultado => console.log(`El resultado es ${resultado}`))
});
if (Notification.permission == "granted") {
    new Notification('Esta es una notificacion', {
        icon: 'img/ccj.png',
        body: 'Codigo con juan, los mejores tutoriales'
    })
}