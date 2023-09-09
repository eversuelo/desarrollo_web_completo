//Decalaracion de funcion
//let resultado = sumar(55, 7); //JavaScript se ejecuta en dos vueltas 1.- Registro 2.- Ejecutar Funciones
//Parametros por DEFAULT
/*function sumar(numero1 = 0, numero2 = 1) {
    return numero1 + numero2;
}
console.log(resultado);*/

let total = 0;

function agregarCarrito(precio) {
    return total += precio;
}

function calcularImpuesto() {
    return 1.15 * total;
}
total = agregarCarrito(200);
total = agregarCarrito(400);
total = agregarCarrito(600);

console.log("total " + total);
const totalAPagar = calcularImpuesto(total);
console.log(totalAPagar)