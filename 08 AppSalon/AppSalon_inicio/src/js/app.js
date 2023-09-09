let pagina = 1;
const cita = {
    nombre: "",
    fecha: "",
    hora: "",
    servicios: []
}
async function mostrarServicio() {
    try {
        const resultado = await fetch('./servicios.json');
        const db = await resultado.json();

        const {
            servicios
        } = db;
        //Generar el HTML
        servicios.forEach(servicio => {
            const {
                id,
                nombre,
                precio
            } = servicio;
            //Dom Scripting
            const nombreServicio = document.createElement('P');
            nombreServicio.textContent = nombre;
            nombreServicio.classList.add('nombre-servicio');
            //Generar el precio del servicio
            const precioServicio = document.createElement('P');
            precioServicio.textContent = `$ ${precio}`;
            precioServicio.classList.add('precio-servicio');

            //Generar div contenedor del servicio
            const servicioDiv = document.createElement('DIV');
            servicioDiv.classList.add('servicio');
            servicioDiv.dataset.idServicio = id;
            //Seleccionar un servicio para la cita
            servicioDiv.onclick = seleccionarServicio;


            //Inyectar precio y nombre al div de servicio
            servicioDiv.appendChild(nombreServicio);
            servicioDiv.appendChild(precioServicio);
            //Inyectar en el HTML
            document.querySelector('#servicios').appendChild(servicioDiv);


        });

    } catch (error) {
        console.error(error);
    }

}
document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function seleccionarServicio(e) {
    //Forzar que el elemento al cual le dimos click sea el div
    let elemento;
    if (e.target.tagName === 'P') {
        elemento = e.target.parentElement

    } else {
        elemento = e.target;
    }

    if (elemento.classList.contains('seleccionado')) {
        elemento.classList.remove('seleccionado');
        const id = parseInt(elemento.dataset.idServicio);
        eliminarServicio(id);
    } else {
        elemento.classList.add('seleccionado');
        //console.log(elemento.firstElementChild.textContent);
        const servicioObj = {
            id: parseInt(elemento.dataset.idServicio),
            nombre: elemento.firstElementChild.textContent,
            precio: elemento.firstElementChild.nextElementSibling.textContent
        }

        agregarServicio(servicioObj);
    }
}

function iniciarApp() {
    mostrarServicio();
    //Resalta el Div actual segun el tab que se presiona
    mostrarSeccion();
    //Oculta o muestra una seccion segun al tab que se presiona
    cambiarSeccion();
    //Paginacion Anterior y Siguiente
    paginaSiguiente();
    paginaAnterior();
    //Comprueba la pagina actual para ocultar o mostrar la paginacion
    botonesPaginador();
    //Muestra el resumen de la cita ( o mensaje del erro en caso de no pasar la validacion);
    mostrarResumen();

    //Almacena el nombre de la cita en ele objeto
    nombreCita();

    //Almacena la fecha en el objet
    fechaCita();
    //Deshabilita Dias Pasado
    deshabilitarFechaAnterior();
    //Almacena la hora en el objeto
    horaCita();

}

function mostrarSeccion() {
    const seccionAnterior = document.querySelector('.mostrar-seccion')
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar-seccion');
    }


    //Eliminar mostrar-seccion de la seccion anterior


    //Agregar la clase de actual en el nuevo tab
    const tabActual = document.querySelector(`[data-paso="${pagina}"]`);
    tabActual.classList.add('actual');
    const seccionActual = document.querySelector(`#paso-${pagina}`);
    seccionActual.classList.add('mostrar-seccion');

    //Resalta el tab actua
    const tab = document.querySelector(`[data-paso="${pagina}"]`);
    tab.classList.add('actual');
}

function cambiarSeccion() {
    const enlaces = document.querySelectorAll('.tabs button');
    enlaces.forEach(enlace => {
        enlace.addEventListener("click", function(e) {
            e.preventDefault();
            pagina = e.target.dataset.paso;
            //Eliminar mostrar-seccion de la seccion anterior
            document.querySelector('.mostrar-seccion').classList.remove('mostrar-seccion');
            //Eliminar la clase de actuual en el tab anterior
            document.querySelector('.tabs .actual').classList.remove('actual');
            //Llamar la funcion mostrar seccion
            mostrarSeccion();

        })
    });
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', () => {
        pagina++;

        botonesPaginador();
    });


}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', () => {

        pagina--;
        botonesPaginador();
    });

}

function botonesPaginador() {
    const paginaSiguiente = document.querySelector('#siguiente');
    const paginaAnterior = document.querySelector('#anterior');
    if (pagina === 1) {

        paginaAnterior.classList.add('ocultar');
    } else if (pagina === 2) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');

    } else if (pagina === 3) {
        paginaSiguiente.classList.add('ocultar');
        paginaAnterior.classList.remove('ocultar');
        mostrarResumen();
    } else {
        pagina = 1;
        if (paginaSiguiente.classList.contains('ocultar')) {
            paginaAnterior.classList.add('ocultar');
            paginaSiguiente.classList.remove('ocultar');
        }
    }
    mostrarSeccion(); //Cambia la seccion 


}

function mostrarResumen() {
    //Destructuring 
    const { nombre, fecha, hora, servicios } = cita;
    //sELECIONAR RESUMEN
    const resumenDiv = document.querySelector('.contenido-resumen');

    //Limpiar el HTML PREVIO
    while (resumenDiv.firstChild) {
        resumenDiv.removeChild(resumenDiv.firstChild);
    }
    //validacion del Objeto
    if (Object.values(cita).includes('')) {
        const noServicios = document.createElement('P');
        noServicios.textContent = "Faltan datos de Servicios, hora ,fecha o nombre";
        noServicios.classList.add('invalidar-cita');
        //agregar a resumen div
        resumenDiv.appendChild(noServicios);
        return;

    }
    const headingCita = document.createElement('H3');
    headingCita.textContent = "Resumen de Cita";
    document.querySelector('.contenido-resumen').appendChild(headingCita);
    //MoSTRAR el resumen
    const serviciosCita = document.createElement('DIV');
    serviciosCita.classList.add('resumen-servicios')

    const headingServicios = document.createElement('H3');
    headingServicios.textContent = "Resumen de Servicios";
    serviciosCita.appendChild(headingServicios);
    let cantidad = 0;
    /**Iterar sobre servicios */
    servicios.forEach(servicio => {
        const { nombre, precio } = servicio;

        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');


        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        const totalServicio = precio.split('$')
        cantidad += parseInt(totalServicio[1].trim());
        precioServicio.textContent = precio;
        precioServicio.classList.add('precio');


        //cOLOCAR TEXTO Y PRECIO EN EL DIV
        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);
        serviciosCita.appendChild(contenedorServicio);


    });
    console.log(cantidad);
    /**Datos del Usuario */
    /**Datos del Usuario */

    const nombreCita = document.createElement('P');
    nombreCita.innerHTML = `<span>Nombre:</span> ${nombre}`;
    resumenDiv.appendChild(nombreCita);


    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fecha}`;
    resumenDiv.appendChild(fechaCita);
    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora}`;
    resumenDiv.appendChild(horaCita);
    resumenDiv.appendChild(serviciosCita);


    const totalPagar = document.createElement('P');
    totalPagar.innerHTML = `<span>Total a Pagar:</span> $${cantidad}`;
    totalPagar.classList.add('total')
    resumenDiv.appendChild(totalPagar);
}

function eliminarServicio(id) {
    const { servicios } = cita;
    cita.servicios = servicios.filter(servicio => servicio.id !== id); //Se trae todos los que sean diferentes a id
    //console.log(cita.servicios);
}

function agregarServicio(servicioObj) {
    const { servicios } = cita;
    cita.servicios = [...servicios, servicioObj];
    //console.log(cita.servicios);
}

function nombreCita() {
    const nombreInput = document.querySelector('#nombre');
    nombreInput.addEventListener('input', (e) => {
        const nombreTexto = e.target.value.trim();
        //Validacion de que nombre texto  tenga un string valido
        if (nombreTexto === '' || nombreTexto.length < 3) {
            mostrarAlerta('Nombre Vacio', 'error');
        } else {
            const alerta = document.querySelector('.alerta');
            if (alerta) {
                alerta.remove();
            }
            cita.nombre = nombreTexto;
        }
    });
}

function mostrarAlerta(mensaje, tipo) {
    //Si hay una alerta previa no crear otra
    const alertaPrevia = document.querySelector('.alerta');
    if (alertaPrevia) {
        return;
    }

    // console.log('el mensaje es ' + mensaje);
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');

    if (tipo === 'error') {
        alerta.classList.add('error');
    }
    const formulario = document.querySelector('.formulario');
    formulario.appendChild(alerta);

    //Eliminar la alerta despues de 3segundos
    setTimeout(() => {
        alerta.remove();
    }, 3000);

}

function fechaCita() {
    const fechaInput = document.querySelector('#fecha');
    fechaInput.addEventListener('input', e => {
        //console.log(e.target.value);
        const dia = new Date(e.target.value).getUTCDate;
        if ([0].includes(dia)) {
            e.preventDefault();
            fechaInput.value = '';
            mostrarAlerta("Dia invalido", 'error');

        } else {
            cita.fecha = fechaInput.value;
            // console.log('Dia Valido')
            //console.log(cita)
        }

    });


}

function deshabilitarFechaAnterior() {
    let fechaDeshabilitar;
    const inputFecha = document.querySelector('#fecha');
    console.log(inputFecha)
    const fechaAhora = new Date();
    const year = fechaAhora.getFullYear();
    const mes = fechaAhora.getMonth() + 1;
    const dia = fechaAhora.getDate() + 1;
    if (mes < 10) {
        fechaDeshabilitar = `${year}-0${mes}`;
    } else {
        fechaDeshabilitar = `${year}-${mes}`;
    }

    if (dia < 10) {
        fechaDeshabilitar += `-0${dia}`;
    } else {

        fechaDeshabilitar += `-${dia}`;

    }
    //Formato deseado AAAA-MM-DD
    inputFecha.min = fechaDeshabilitar;

}

function horaCita() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', (e) => {
        const horaCita = e.target.value;
        const hora = horaCita.split(':');
        console.log(hora);
        if (hora[0] < 10 || hora[0] > 18) {
            mostrarAlerta("Hora no valida", "error");
            setTimeout(() => {
                inputHora.value = '';
            }, 1000);
        } else {
            cita.hora = horaCita;
        }
    });
}