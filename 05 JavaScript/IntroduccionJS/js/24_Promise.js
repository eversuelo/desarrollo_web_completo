'use strict'
//Resolve se ejecuta cuando el primise se cumple
/*Resolve y reject siempre van y son funciones*/
const usuarioAutenticado = new Promise((resolve, reject) => {
    const auth = false;

    if (auth) {
        resolve("Usuario Autenticado Correctamente");
    } else {
        reject("No se pudo Inciar Sesion Undefined");
    }
});
usuarioAutenticado.then(function(resultado) {
        console.log(`Desde el Promise, el resultado es ${resultado}`);
    })
    .catch(function(error) {
        console.log(`No se pudo iniciar sesion, el error: ${error}`);

    })
    //En los promses existen 3 valores posibles
    /*Pending: No se ha cumplido pero tampoco se ha rechazado
    Fullfilled: Ya se Cumplio
    Reeccted: Se ha rechazado o no se pudo cumplir*/