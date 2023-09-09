'use strict'
const producto = {
    nombreProducto: "Monitor 20 Pulgadas",
    precio: 300,
    disponible: true
}
const producto1 = {
        nombreProducto: "Monitor 20 Pulgadas",
        precio: 300,
        disponible: true
    }
    //Congelar un objeto y permitir que no sea modificado
Object.freeze(producto); //No permite agregar ni eliminar propiedades
Object.seal(producto1); //Si te permite modificar las propiiedades existentes
console.log(producto1.disponible = false);
console.log(producto1);

// console.log(producto.disponible = false); Marca Error
console.log(producto);
console.log(Object.isFrozen(producto));