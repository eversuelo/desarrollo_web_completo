let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;
document.addEventListener("DOMContentLoaded", function () {
  iniciarApp();
});
const cita = {
  id: '',
  nombre: "",
  fecha: "",
  hora,
  servicios: [],
};
function iniciarApp() {
  mostrarSeccion(); // Muestra y oculta las secciones
  tabs(); // Cambia la sección cuando se presionen los tabs
  botonesPaginador(); // Agrega o quita los botones del paginador
  paginaSiguiente();
  paginaAnterior();

  consultarAPI(); //Consulta la API en el backend
  idCliente();
  nombreCliente();
  seleccionarFecha();//Añade la Fecha de la cita del objeto
  selecionarHora();// Añade la hora de la cita al Objeto
  mostrarResumen();
}
function mostrarSeccion() {
  // Ocultar la sección que tenga la clase de mostrar
  const seccionAnterior = document.querySelector(".mostrar");
  if (seccionAnterior) {
    seccionAnterior.classList.remove("mostrar");
  }

  // Seleccionar la sección con el paso...
  const pasoSelector = `#paso-${paso}`;
  const seccion = document.querySelector(pasoSelector);
  seccion.classList.add("mostrar");

  // Quita la clase de actual al tab anterior
  const tabAnterior = document.querySelector(".actual");
  if (tabAnterior) {
    tabAnterior.classList.remove("actual");
  }

  // Resalta el tab actual
  const tab = document.querySelector(`[data-paso="${paso}"]`);
  tab.classList.add("actual");
}
function tabs() {
  // Agrega y cambia la variable de paso según el tab seleccionado
  const botones = document.querySelectorAll(".tabs button");
  botones.forEach((boton) => {
    boton.addEventListener("click", function (e) {
      e.preventDefault();

      paso = parseInt(e.target.dataset.paso);
      mostrarSeccion();

      botonesPaginador();
    });
  });
}
function botonesPaginador() {
  const paginaAnterior = document.querySelector("#anterior");
  const paginaSiguiente = document.querySelector("#siguiente");
  //console.log(paginaAnterior);
  //console.log(paginaSiguiente);
  if (paso === 1) {
    paginaAnterior.classList.add("ocultar");
    paginaSiguiente.classList.remove("ocultar");
  } else if (paso === 3) {
    paginaAnterior.classList.remove("ocultar");
    paginaSiguiente.classList.add("ocultar");
    mostrarResumen();
  } else {
    paginaAnterior.classList.remove("ocultar");
    paginaSiguiente.classList.remove("ocultar");
  }

  mostrarSeccion();
}
function paginaAnterior() {
  const paginaAnterior = document.querySelector("#anterior");
  paginaAnterior.addEventListener("click", function () {
    if (paso <= pasoInicial) return;
    paso--;

    botonesPaginador();
  });
}
function paginaSiguiente() {
  const paginaSiguiente = document.querySelector("#siguiente");
  paginaSiguiente.addEventListener("click", function () {
    if (paso >= pasoFinal) return;
    paso++;

    botonesPaginador();
  });
}

async function consultarAPI() {
  try {
    const url = "http://localhost:3000/api/servicios";
    const resultado = await fetch(url);
    const servicios = await resultado.json();
    mostrarServicios(servicios);
  } catch (error) {
    console.log(error);
  }
}
function mostrarServicios(servicios) {
  // console.log(servicios);
  servicios.forEach((servicio) => {
    const { id, nombre, precio } = servicio;
    const nombreServicio = document.createElement("P");
    nombreServicio.classList.add("nombre-servicio");
    nombreServicio.textContent = nombre;

    const precioServicio = document.createElement("P");
    precioServicio.classList.add("precio-servicio");
    precioServicio.textContent = `$${precio}`;

    const servicioDiv = document.createElement("DIV");
    servicioDiv.classList.add("servicio");
    servicioDiv.dataset.idServicio = id;
    servicioDiv.appendChild(nombreServicio);
    servicioDiv.appendChild(precioServicio);
    servicioDiv.onclick = function () {
      seleccionarServicio(servicio);
    };
    document.querySelector("#servicios").appendChild(servicioDiv);
  });
}
function seleccionarServicio(servicio) {
  const { id } = servicio;
  const { servicios } = cita;
  const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
  //Comprobar si un servicio ya fue agregado
  if (servicios.some((agregado) => agregado.id === id)) {
    //Eliminarlo
    cita.servicios = servicios.filter((agregado) => agregado.id !== id);
    divServicio.classList.remove("seleccionado");
  } else {
    //Agregarlo
    cita.servicios = [...servicios, servicio];
    divServicio.classList.add("seleccionado");
  }

}
function nombreCliente() {
  cita.nombre = document.querySelector("#nombre").value;
  // console.log(cita.nombre);
}
function seleccionarFecha() {
  const inputFecha = document.querySelector("#fecha");
  inputFecha.addEventListener("input", function (e) {
    const dia = new Date(e.target.value).getUTCDay();
    if ([6, 0].includes(dia)) {
      e.target.value = "";
      mostrarAlerta("FINES DE SEMANA NO PERMITIDOS", "error");
    } else {
      cita.fecha = e.target.value;
    }
  });
}
function mostrarAlerta(mensaje, tipo, elemento = ".formulario", desaparece = true) {
  const alertaPrevia = document.querySelector("alerta");
  if (alertaPrevia) alertaPrevia.remove();
  const alerta = document.createElement("DIV");
  alerta.textContent = mensaje;
  alerta.classList.add(tipo);
  alerta.classList.add("alerta");
  const referencia = document.querySelector(elemento);
  referencia.appendChild(alerta);
  if (desaparece) {
    setTimeout(() => {
      alerta.remove();
    }, 3000);
  }
}
function selecionarHora() {
  const inputHora = document.querySelector('#hora');
  inputHora.addEventListener('input', function (e) {
    const horaCita = e.target.value;
    const hora = horaCita.split(':')[0];
    if (hora < 10 || hora > 20) {
      e.target.value = '';
      mostrarAlerta('Hora no valida', 'error');
    } else {
      cita.hora = e.target.value;
    }
  });
}
function mostrarResumen() {
  const resumen = document.querySelector('.contenido-resumen');
  //Limpiar el contenido resumen
  while (resumen.firstChild !== null) {
    resumen.removeChild(resumen.firstChild);
  }
  if (Object.values(cita).includes('') || cita.servicios.length == 0) {
    mostrarAlerta('Hacen Falta Datos', 'error', '.contenido-resumen', false);
    return;
  }
  //Formatear el div de resumen
  const { nombre, fecha, hora, servicios } = cita;
  //Heading Para servicios y Resumen
  const headingServicios = document.createElement('h3');
  headingServicios.textContent = 'Resumen de Servicios'
  resumen.appendChild(headingServicios);


  servicios.forEach(servicio => {
    const { nombre, precio, id } = servicio;
    const contenedorServicio = document.createElement('DIV');
    contenedorServicio.classList.add('contenedor-servicio');
    const textoServicio = document.createElement('P');
    textoServicio.textContent = nombre;
    const precioServicio = document.createElement('p');
    precioServicio.innerHTML = `<span>Precio:</span>$${precio}`;
    contenedorServicio.appendChild(textoServicio);
    contenedorServicio.appendChild(precioServicio);

    resumen.appendChild(contenedorServicio);


  });
  //Heading para Cita en resumen
  const headingCita = document.createElement('h3');
  headingCita.textContent = 'Resumen de Cita'
  resumen.appendChild(headingCita);

  const nombreCliente = document.createElement('DIV');
  nombreCliente.innerHTML = `<span>Nombre:</span>${nombre}`;
  //Formatear la Fecha en español
  const fechaObj = new Date(fecha);
  const mes = fechaObj.getMonth();
  const dia = fechaObj.getDate() + 2;
  const anio = fechaObj.getFullYear();
  const fechaUTC = new Date(Date.UTC(anio, mes, dia));
  const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  const fechaFormateada = fechaUTC.toLocaleDateString('es-MX', opciones);
  const fechaCita = document.createElement('p');
  fechaCita.innerHTML = `<span>Fecha:</span>${fechaFormateada}`;
  const horaCita = document.createElement('p');
  horaCita.innerHTML = `<span>Hora:</span>${hora} Horas`;
  //Boton para Crear una Cita
  const botonReservar = document.createElement('BUTTON');
  botonReservar.classList.add('boton');
  botonReservar.textContent = 'Reservar Cita';
  botonReservar.onclick = reservarCita;
  resumen.appendChild(nombreCliente);
  resumen.appendChild(fechaCita);
  resumen.appendChild(horaCita);
  resumen.appendChild(botonReservar);
}
async function reservarCita() {
  const datos = new FormData();
  const { nombre, fecha, hora, servicios, id } = cita;
  const idServicios = servicios.map(servicio => servicio.id);
  datos.append('usuarioId', cita.id);
  datos.append('fecha', fecha);
  datos.append('hora', hora);
  datos.append('servicios', idServicios);
  try {
    // Petición hacia la api
    const url = 'http://localhost:3000/api/citas'
    const respuesta = await fetch(url, {
      method: 'POST',
      body: datos
    });

    const resultado = await respuesta.json();
    console.log(resultado);

    if (resultado.resultado) {
      Swal.fire({
        icon: 'success',
        title: 'Cita Creada',
        text: 'Tu cita fue creada correctamente',
        button: 'OK'
      }).then(() => {
        setTimeout(() => {
          window.location.reload();
        }, 3000);
      })
    }
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Hubo un error al guardar la cita'
    })
  }

}
function idCliente() {
  cita.id = document.querySelector("#id").value;
}