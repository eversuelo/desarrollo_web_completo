'use strict'
//For LOOP
for (let i = 0; i < 10; i++) {
    if (i % 2 === 0) {
        console.log("Es par " + i);
    } else {
        console.log("El numero es impar" + i);
    }
}

const carrito = [
    { nombre: 'Monitor 27 Pulgadas', precio: 500 },
    { nombre: 'Monitor  31 Pulgadas', precio: 600 },
    { nombre: 'Tablet', precio: 300 },
    { nombre: 'Television 60 Pulgadas', precio: 800 },
    { nombre: 'Silla Gamer', precio: 1000 },
    { nombre: 'Audifonos', precio: 200 }
];

for (let i = 0; i < carrito.length; i++) {
    console.log(carrito[i].nombre);
}

//While Loop
let i = 0;

while (i < 10) {
    if (i % 2 === 0) {
        console.log("Es par " + i);
    } else {
        console.log("El numero es impar" + i);
    }
    i++
}
//Do While Loop
i = 0;
do {
    if (i % 2 === 0) {
        console.log("Es par " + i);
    } else {
        console.log("El numero es impar" + i);
    }
    i++
} while (i < 10);