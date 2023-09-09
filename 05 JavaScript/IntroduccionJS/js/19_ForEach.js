const carrito = [
    { nombre: 'Monitor 27 Pulgadas', precio: 500 },
    { nombre: 'Monitor  31 Pulgadas', precio: 600 },
    { nombre: 'Tablet', precio: 300 },
    { nombre: 'Television 60 Pulgadas', precio: 800 },
    { nombre: 'Silla Gamer', precio: 1000 },
    { nombre: 'Audifonos', precio: 200 }
];
//Solo se ejecutan en arreglos
//For Each iTERAR Y mOSTRAR EN CONSOLA
carrito.forEach(function(producto) {
    console.log(producto.nombre);
});
//Map CREAR UN ARREGLO
carrito.map(function(producto) {
    console.log(producto.nombre);
});

const arreglo1 = carrito.forEach(producto => producto.nombre);
const arreglo2 = carrito.map(producto => producto.nombre);

console.log(arreglo1);
console.log(arreglo2);