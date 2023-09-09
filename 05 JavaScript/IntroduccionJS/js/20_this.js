//This
//Los Arrow Function hacen referencia a la ventana global, mientras function el this al objeto
//Obbject Literal
const reservacion = {
    nombre: 'Ever',
    apellido: 'Torres',
    total: '20',
    pagado: true,
    informacion: function(mensaje) {
        console.log(`El Cliente ${this.nombre} ${this.apellido} reservo y su cantidad a pagar es ${this.total}, dejo pagado:${this.pagado} y el mensaje es ${mensaje}`);
    }
}
console.log(reservacion)
reservacion.informacion("Gracias")