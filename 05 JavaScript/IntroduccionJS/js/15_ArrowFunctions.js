'use strict'
const sumar = (n1, n2) => {
    console.log(n1 + n2);
}
sumar(5, 10)
const aprendiendo = (tec) => {
    console.log(`Aprendiendo ${tec}`)
}
aprendiendo('Java')
const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'];
const carrito = [
    { nombre: 'Monitor 27 Pulgadas', precio: 500 },
    { nombre: 'Monitor  31 Pulgadas', precio: 600 },
    { nombre: 'Tablet', precio: 300 },
    { nombre: 'Television 60 Pulgadas', precio: 800 },
    { nombre: 'Silla Gamer', precio: 1000 },
    { nombre: 'Audifonos', precio: 200 }
];

//forEaCH
meses.forEach((mes) => {
    if (mes == 'Marzo') {
        console.log("Marzo si Existe")
    }
});
//Includes
let resultado;
//Some ideal para arreglo de objetos
resultado = carrito.some(producto => producto.nombre === 'Audifonos');
console.log(resultado);

//Reduce
resultado = carrito.reduce(function(total, producto) {
    return total + producto.precio
}, 0);
console.log(resultado);
//Filter

resultado = carrito.filter(producto => producto.precio < 400);
console.log(resultado);
resultado = carrito.filter(producto => producto.nombre == 'Tablet');
console.log(resultado);