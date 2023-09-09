//Async await
'use strict'

function descargarNuevosClientes() {
    return new Promise(resolve => {
        console.log("Descargando Clientes..espere...");
        setTimeout(() => {
            resolve('Los clientes fueron descargados');
        }, 5000);
    });
}

function descargarUltimosPedidos() {
    return new Promise(resolve => {
        console.log("Descargando Pedidos..espere...");
        setTimeout(() => {
            resolve('Los Pedidos fueron descargados');
        }, 5000);
    });
}


async function app() {
    try {
        // const clientes = await descargarNuevosClientes();
        // const pedidos = await descargarUltimosPedidos();
        // console.log(clientes);
        // console.log(pedidos);
        const resultado = await Promise.all([descargarNuevosClientes(), descargarUltimosPedidos()]);
        console.log(resultado[0]);
        console.log(resultado[1]);
    } catch (error) {
        console.log(error);
    }
}
app();
console.log("Este codigo no se bloquea");