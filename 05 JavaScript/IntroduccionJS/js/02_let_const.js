'use strict'
let variable = 'hola';
const constante = "Soy constante"; //Necesita inicializarse forzosamente con valor

/*Tipos de Datos*/
const producto = "Monitor 20 Pulgada\"";
const producto2 = String("Monitor 30 Pulgadas\"");
console.log(typeof producto2);
console.log(producto);
/*Metodos Asociados a los String*/
console.log("La longitud es " + producto.length);

//Index Of
console.log(producto.indexOf('Pulgada')); //-1 no enconreado > Encontrado
console.log("¿Tiene Pulgadas? " + producto.includes('20'));