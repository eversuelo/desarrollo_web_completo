//POO
/*Oject Lteral*/
const producto = {
    nombre: 'Tablet',
    precio: 300
}

//Crear Funciones que solo e utilizan en un ojeto especifico
Producto.prototype.formatearProducto = function() {
    return `El producto ${this.nombre} tiene un precio de $ ${this.precio}`;
}

//Object Constructor -Clase
function Producto(nombre, precio) {
    this.nombre = nombre;
    this.precio = precio;

}
const producto2 = new Producto('Monitor Curvo de 49 Pulgadas', 800);

console.log(producto2.formatearProducto());