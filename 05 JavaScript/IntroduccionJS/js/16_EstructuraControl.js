'use strict'
/*
const puntaje = 1000;
if (puntaje == 1000) {
    console.log("El puntaje es " + puntaje);
} else {
    console.log("El puntaje es menor que 1000");
}*/
const efectivo = 1000;
const carrito = 800;

if (efectivo > carrito) {
    console.log("El usuario puede pagar");
} else {
    console.log("El usuario no puede pagar");
}
const rol = 'ADMINISTRADOR'
if (rol == "ADMINISTRADOR") {
    console.log("Acceso a todo el sistema")
} else if (rol == "EDITOR") {
    console.log("Eres Editor ");
} else {
    console.log("No tienes aCCESO");
}