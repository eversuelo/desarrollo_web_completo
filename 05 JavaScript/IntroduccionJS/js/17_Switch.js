const metodoPago = 'tarjeta'
switch (metodoPago) {
    case 'tarjeta':
        console.log("Pagaste con tarjeta");
        break;
    case 'cheque':
        console.log("El usuario  pagara con cheque, revisar los fondos");
        break;
    case 'efectivo':
        console.log("El usuario  pagara con efectivo.");
        break;
    default:
        console.log("Aun no haz pagado");
        break;

}