'use strict'
//Clases 
class Producto {
    constructor(nombre, precio) {
        this.nombre = nombre;
        this.precio = precio;
    }

    formatearProducto() {
        return `El producto ${this.nombre} tiene un precio de $ ${this.precio}`;
    }
    pecioProducto() {
        return this.precio;
    }
}
/*Oject Lteral*/

const producto2 = new Producto('Monitor Curvo de 49 Pulgadas', 800);
const producto = new Producto("Control Gamer", 500);
console.log(producto.formatearProducto());
console.log(producto.pecioProducto());

class Libro extends Producto {
    constructor(nombre, precio, isbn) {
            super(nombre, precio); //Lo que existe dentro de la clase padre lo colocas en super
            this.isbn = isbn;

        }
        /*Reescribiendo Prodcuto*/
    formatearProducto() {
        return `El producto ${this.nombre} tiene un precio de $ ${this.precio} y su ISBN: ${this.isbn}`;
    }
}
const libro = new Libro('JavaScript la Revolucion', 120, '66559985555');
console.log(libro.formatearProducto());