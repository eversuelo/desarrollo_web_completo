'use strict'
//Decalaracion de funcion
sumar(); //JavaScript se ejecuta en dos vueltas 1.- Registro 2.- Ejecutar Funciones
function sumar() {
    console.log(10 * 10);
}

//Expresion de la Funcion
const sumar2 = function() {
    console.log(3 + 3);
}
sumar2();

//IIFE Funciones que se mandan a llamar asi misma
(function() {
    console.log("Hola me Puedo llamar");
    console.log("Mi deber es proteger las Variables dentro de mi");
})();

/*Diferencia de un Metodo y una Funcion*/
const numero1 = 20;
const numero2 = "20";
console.log(parseInt(numero2)); //parseInt() Es una funcion
console.log(numero1.toString()); // .toString() es un metodo