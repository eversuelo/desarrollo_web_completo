//querySelector
const heading = document.querySelector(".header__texto h2"); //retorna 0 o 1 elemento
//Si te equivocas en el selectr, va aparecer como null
heading.textContent = "Nuevo Heading";
heading.classList.add("nueva-clase");
console.log(heading);

//querySelectorAll
const enlaces = document.querySelectorAll(".navegacion a");
console.log(enlaces[0]);
//enlaces[0].textContent = 'Nuevo Texto para Enlace';
enlaces[0].classList.add("nueva-clase");
console.log(enlaces);
//enlaces[0].classList.remove('navegacion__enlace');
//getElementById
const heading2 = document.getElementById("heading");
heading2.classList.add("nueva-clase2");
console.log(heading2);
heading2.textContent = "Nuevo Heading 2";

/************************
 * Generar un nuevo enlace
 */
const nuevoEnlace = document.createElement("A");
//Agregar el href
nuevoEnlace.href = "https://www.google.com";

//Agregar el texto
nuevoEnlace.textContent = "Google";

//Agregar la clase
nuevoEnlace.classList.add("navegacion__enlace");

//Agregarlo al documento
const navegacion = document.querySelector(".navegacion");
navegacion.appendChild(nuevoEnlace);
console.log(nuevoEnlace);

/************
 * Eventos
 */
console.log(1);
window.addEventListener("load", function () {
    console.log(2);
});
window.onload = function () {
    console.log(3);
}
document.addEventListener("DOMContentLoaded", function () {
    console.log(4);
}
);
console.log(5);


/**********************
 * Seleccionar elementos y asociarles un evento
 */
const btnEnviar = document.querySelector(".boton--primario");
btnEnviar.addEventListener("click", function (e) {
    e.preventDefault();
    console.log(e);
    //Validar un formulario
    console.log("enviando formulario");
}
);

