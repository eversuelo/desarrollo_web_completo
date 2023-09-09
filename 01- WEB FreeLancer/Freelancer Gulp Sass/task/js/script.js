eventListeners();
var listaProyectos = document.querySelector('ul#proyectos');
//console.log("funciona");

function eventListeners() {
    //Document REady Barra de Progreso

    document.addEventListener('DOMContentLoaded', function() {
        actualizaProgreso();

    });

    //boton para crear proyecto
    document.querySelector('.crear-proyecto a').addEventListener('click', nuevoProyecto);

    //Boton para una nueva tarea
    document.querySelector('.nueva-tarea').addEventListener('click', agregarTarea);

    //JS Dellegation, botones para las acciones de las tareas
    document.querySelector('.listado-pendientes').addEventListener('click', accionesTareas);

}

function nuevoProyecto(e) {
    e.preventDefault();
    //lista de proyectos
    var listaProyectos = document.querySelector('#proyectos');
    ///Crea un INput para el nombre del nuevo Proyecto
    var nuevoProyecto = document.createElement('li');
    nuevoProyecto.innerHTML = '<input type="text" id="nuevo-proyecto">';
    listaProyectos.appendChild(nuevoProyecto);
    //Seleccionar el ID nuevoProyecto
    var inputNuevoProyecto = document.querySelector('#nuevo-proyecto');
    //al presionar enter crea el proyecto
    inputNuevoProyecto.addEventListener('keypress', function(e) {
        var tecla = e.which || e.keyCode;
        if (tecla === 13) {
            guardarProyectoDB(inputNuevoProyecto.value);
            listaProyectos.removeChild(nuevoProyecto);
        }
    });
}


function guardarProyectoDB(nombreProyecto) {
    // Crear llamado ajax
    var xhr = new XMLHttpRequest();

    // enviar datos por formdata
    var datos = new FormData();
    datos.append('proyecto', nombreProyecto);
    datos.append('accion', 'crear');

    // Abrir la conexion
    xhr.open('POST', 'inc/modelos/modelo-proyecto.php', true);

    // En la carga
    xhr.onload = function() {
        if (this.status === 200) {
            // obtener datos de la respuesta
            var respuesta = JSON.parse(xhr.responseText);
            var proyecto = respuesta.nombre_proyecto,
                id_proyecto = respuesta.id_insertado,
                tipo = respuesta.tipo,
                resultado = respuesta.respuesta;

            // Comprobar la inserción
            if (resultado === 'correcto') {
                // fue exitoso
                if (tipo === 'crear') {
                    // Se creo un nuevo proyecto
                    // inyectar en el HTML
                    var nuevoProyecto = document.createElement('li');
                    nuevoProyecto.innerHTML = `
                        <a href="index.php?id_proyecto=proyecto:${id_proyecto}" id="proyecto:${id_proyecto}">
                            ${proyecto}
                        </a>
                    `;
                    // agregar al html
                    listaProyectos.appendChild(nuevoProyecto);

                    // enviar alerta
                    swal({
                            title: 'Proyecto Creado',
                            text: 'El proyecto: ' + proyecto + ' se creó correctamente',
                            type: 'success'
                        })
                        .then(resultado => {
                            // redireccionar a la nueva URL
                            if (resultado.value) {
                                window.location.href = 'index.php?id_proyecto=' + id_proyecto;
                            }
                        })


                } else {
                    // Se actualizo o se elimino
                }
            } else {
                // hubo un error
                swal({
                    type: 'error',
                    title: 'Error!',
                    text: 'Hubo un error!'
                })
            }
        }
    }

    // Enviar el Request
    xhr.send(datos);

}

function agregarTarea(e) {
    e.preventDefault();
    var nombreTarea = document.querySelector('.nombre-tarea').value;
    //Validar que el campo tenga algo escrito
    if (nombreTarea === '') {
        swal({
            title: 'Error',
            text: 'Una Tarea no puede ir vacía',
            type: 'error'

        });
    } else {
        //La tarea tiene algo, insetar en PHP
        //Crea llamado Ajax
        var xhr = new XMLHttpRequest();

        //crear FormData
        var datos = new FormData();
        datos.append('tarea', nombreTarea);
        datos.append('accion', 'crear');
        datos.append('id_proyecto', document.querySelector('#id_proyecto').value);


        //Abrir la conexion
        xhr.open('POST', 'inc/modelos/modelo-tareas.php');

        //ejecutarlo y respuesta 
        xhr.onload = function() {
            // console.log("Entrada Onload");
            if (this.status === 200) {
                //todo correcto
                var respuesta = JSON.parse(xhr.responseText);
                //  console.log(respuesta);
                var resultado = respuesta.respuesta,
                    tarea = respuesta.tarea,
                    id_insertado = respuesta.id_insertado,
                    tipo = respuesta.tipo

                if (respuesta.respuesta === 'correcto') {


                    if (tipo = 'crear') {
                        //lanzar la alerta 

                        swal({
                            title: 'Tarea Agregada Correctamente',
                            text: 'La Tarea ' + tarea + 'Se creo correctamente',
                            type: 'success'
                        });
                        //Seleccionar el parrafo con la lista vaca
                        var parrafoListaVacia = document.querySelectorAll('.lista-vacia');
                        if (parrafoListaVacia.length > 0) {
                            document.querySelectorAll('.lista-vacia').remove();
                        }
                        //COnstruir un Template
                        var nuevaTarea = document.createElement('li');

                        //agregamos el ID
                        nuevaTarea.id = 'tarea' + id_insertado;
                        //agregar la clase tarea
                        nuevaTarea.classList.add('tarea');
                        //insertar en el html
                        nuevaTarea.innerHTML = `
                        <p>${tarea}</p>
                        <div class="acciones">
                            <i class="far fa-check-circle"></i>
                            <i class="fas fa-trash"></i>
                        </div>
                        `;

                        //agregar al HTML Dom DOcument
                        var listado = document.querySelector('.listado-pendientes ul');
                        listado.appendChild(nuevaTarea);
                        document.querySelector('.agregar-tarea').reset;
                        //Actualiza Progreso
                        actualizaProgreso();
                    }
                } else {
                    swal({
                        title: 'Hubo un Error',
                        text: 'Presiona OK para abrir el dashboard',
                        type: 'error'
                    });
                }
            } else {
                console.log("Server Estatus Error");
            }
        }
        xhr.send(datos);


    }

}
//Acciones de los botones
function accionesTareas(e) {
    e.preventDefault();
    /*Click en todo el listado de Tareas*/
    //console.log('Hiciste CLick');
    //con e.target se sabe a que elemento da click
    //console.log(e.target);
    if (e.target.classList.contains('fa-check-circle')) {
        if (e.target.classList.contains('completo')) {
            e.target.classList.remove('completo');
            cambiarEstadoTarea(e.target, 0);

        } else {
            e.target.classList.add('completo');
            cambiarEstadoTarea(e.target, 1);
        }
    } else if (e.target.classList.contains('fa-trash')) {
        Swal.fire({
            title: 'Seguro(a)?',
            text: "Esta Acccion o se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                var tareaEliminar = e.target.parentElement.parentElement;

                //Borrar de la BD
                eliminarTareaBD(tareaEliminar);



                //Borrar del HTML
                tareaEliminar.remove();


                Swal.fire(
                    'Borrado!',
                    'Tu archivo ha sido borrado',
                    'success'
                )
            }
        });
    } else {
        console.log('Hiciste CLick en Otro Lado');
    }

}
//Cmpleta o Descompleta una tarea

function cambiarEstadoTarea(tarea, estado) {
    var idTarea = tarea.parentElement.parentElement.id.split(':')
        //crear llamado a AJAX
    var xhr = new XMLHttpRequest();
    // console.log(tarea + estado)
    //informacion
    var datos = new FormData();
    datos.append('id', idTarea[1]);
    datos.append('accion', 'actualizar');
    datos.append('estado', estado);



    //abrir la conexion
    xhr.open('POST', 'inc/modelos/modelo-tareas.php', true);
    //on load
    xhr.onload = function() {
        if (this.status === 200) {
            console.log(xhr.responseText);
            actualizaProgreso();
        }
    }
    xhr.send(datos);
}

function eliminarTareaBD(tarea) {
    var idTarea = tarea.id.split(':')
        //crear llamado a AJAX
    var xhr = new XMLHttpRequest();
    //informacion
    var datos = new FormData();
    datos.append('id', idTarea[1]);
    datos.append('accion', 'eliminar');

    //abrir la conexion
    xhr.open('POST', 'inc/modelos/modelo-tareas.php', true);
    //on load
    xhr.onload = function() {
        if (this.status === 200) {
            console.log(xhr.responseText);
            //Comprobar que haya mas tareas
            var listaTareasRestantes = document.querySelectorAll('li.tarea');
            if (listaTareasRestantes.length === 0) {
                document.querySelector('.listado-pendientes').innerHTML = "<p class='lista-vacia'>No hay tareas en este proyecto</p>";
            }
            //Actualiza Progreso
            actualizaProgreso();
        }
    }
    xhr.send(datos);
}
//Actualiiza elavance del Proyecto
function actualizaProgreso() {
    const tareas = document.querySelectorAll('li.tarea');
    //Obtener las tareascompletadas
    console.log('Funciona');
    const tareasCompletadas = document.querySelectorAll('i.completo');
    //determinar el avance
    const avance = Math.round((tareasCompletadas.length / tareas.length) * 100);
    const porcentaje = document.querySelector('#porcentaje');
    porcentaje.style.width = avance + '%';

}