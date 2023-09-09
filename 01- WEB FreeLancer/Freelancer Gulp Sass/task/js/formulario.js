eventListeners();

function eventListeners() {
    document.querySelector('#formulario').addEventListener('submit', validarRegistro);
}

function validarRegistro(e) {
    e.preventDefault();
    var usuario = document.querySelector('#usuario').value,
        password = document.querySelector('#password').value,
        tipo = document.querySelector('#tipo').value;

    if (usuario === '' || password === '') {
        //La Validacion Fallo
        swal({
            type: 'error',
            title: 'Oops...',
            text: 'Something went wrong!'
        });
    } else {
        //Ambos Campos son corectos, mandar a ejecutar Ajax
        //Datos que se envian al servidor
        var datos = new FormData();
        datos.append('usuario', usuario);
        datos.append('password', password);
        datos.append('accion', tipo);

        //Crear el llamado a Ajax
        var xhr = new XMLHttpRequest();
        //abrir la conexion
        xhr.open('POST', 'inc/modelos/modelo-admin.php', true);
        //xhr onload Checar peticion
        xhr.onload = function() {
                if (this.status === 200) {
                    var respuesta = JSON.parse(xhr.responseText);

                    //Si la respuesta es correcta
                    if (respuesta.respuesta === 'correcto') {
                        // Si es un nuevo usuario

                        if (respuesta.tipo === 'crear') {
                            swal({
                                title: 'Usuario Creado',
                                text: 'El usuario se creó correctamente',
                                type: 'success'
                            });
                        } else if (respuesta.tipo === 'login') {
                            swal({
                                    title: 'Login CORRECTO',
                                    text: 'Presiona OK para abrir el dashboard',
                                    type: 'success'
                                })
                                .then(resultado => {
                                    if (resultado.value) {
                                        console.log(resultado);
                                        window.location.href = 'index.php';

                                    }
                                })
                        }
                    } else {
                        swal({
                            title: 'Hubo un error',
                            text: 'La tarea ha fallado correctamente',
                            type: 'error'
                        });
                    }
                }
            }
            //Envirar la Petición
        xhr.send(datos);
    }
}