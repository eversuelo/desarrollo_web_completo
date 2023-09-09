const producto = {
    nombreProducto: "Monitor 20 Pulgadas",
    precio: 300,
    disponible: true
}
const medidas = {
        pes: '1 kg',
        medida: '0.40mts'
    }
    //Practica para unir Objetos
const nuevoProducto = {...producto, ...medidas }; //Spread Operator son los '...'
console.log(nuevoProducto);

//Arreglos o Arrays
const numeros = [10, , 20, 30, 40, 50];
console.table(numeros);
const meses = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo');
console.table(meses);
console.log(meses[2]); //Accediendo al lugar 3
//Conocer la extension de un arreglo
console.log("Numero de Meses " + meses.length);

//Agregando Elementos a un Arreglo
meses[5] = "Junio";
meses[6] = "Julio"; //Tienes que Conocer la posicion del arreglo
meses.push("Septiembre"); //Agrega al final del Arreglo

meses.unshift("Diciembre"); //Agrega al Inicio

//Accediendo for Each
meses.forEach(function(valor, numero) {
    console.log(valor, numero);
});
//Data Structures
meses.pop(); //Elimina el ultimo elemento
meses.shift(); //Elimina el primer elemento

meses.splice(2, 1); //Desde que elemento eliminas y cuantos quieres eliminar a partir de ahi
console.table(meses);
const nuevoArreglo = [...meses, 'Marzo', 'Septiembre']
console.table(nuevoArreglo);
//Nota Adicional, todo lo que sean objetos se puedde modificar con const