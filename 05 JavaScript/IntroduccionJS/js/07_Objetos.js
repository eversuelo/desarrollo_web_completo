//Objetos
const producto = {
        nombreProducto: "Monitor 20 Pulgadas",
        precio: 300,
        disponible: true
    }
    /*
    console.log(producto);
    console.log(producto.disponible);
    console.log(producto['nombreProducto']);
    */
    /*Agregar nuevas Propiedades*/
producto.imagen = 'imagen.jpg';
/*Eliminar Propiedades*/
delete producto.disponible;
console.log(producto);