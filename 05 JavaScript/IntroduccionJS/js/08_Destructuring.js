//Objetos
const producto = {
    nombreProducto: "Monitor 20 Pulgadas",
    precio: 300,
    disponible: true
}
const precioProducto = producto.precio;
console.log(precioProducto);
//Destructuring de un Objeto es destructurarlo

const { precio } = producto;
const { nombreProducto } = producto;
console.log(precio);
console.log(nombreProducto); //Debe de tener el nombre de la propiedad a extraer