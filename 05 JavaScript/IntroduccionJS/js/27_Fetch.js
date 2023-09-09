'use strict'
console.log("Todo Bien");

function obtenerEmpleados() {
    const archivo = 'empleados.json'
    fetch(archivo)
        .then(resultado => {
            return resultado.json();
        }).then(datos => {
            console.log(datos);
            const { empleados } = datos;
            empleados.forEach(element => {
                console.log(element);
            });
        });
}
obtenerEmpleados();