<?php include 'includes/header.php';
$autenticado = false;
$admin = false;
if ($autenticado || $admin  && true) {
    echo "Usuario Auntenticado Correctamente <br>";
} else {
    echo "Usuario No Auntenticado  <br>";
}
$cliente = [
    'nombre' => 'Juan',
    'saldo' => 00,
    'informacion' => [
        'tipo' => 'Premium'
    ]
];
if (!empty($cliente)) {
    echo "EL ARREGLO no esta vasio <br>";
    if ($cliente['saldo'] > 0) {
        echo "Hay saldo disponnble <br>";
    } else if ($cliente['informacion']['tipo'] == 'Premium') {
        echo "El cliente es Premium ¿cuenta con linea de credito?<br>";
    } else {
        echo "Saldo insuficiente<br>";
    }
} else {
    echo "El arreglo esta vaio <br>";
}


//Switch
$tecnologia = 'PHP';
switch ($tecnologia) {
    case 'PHP':
        echo "Aprendiendo PHP <br>";
        break;
    case 'JS':
        echo "Aprendiendo JS <br>";
        break;
    case 'C':
        echo "Aprendiendo C <br>";
        break;
    default:
        echo "Aprendiendo algo <br>";
        break;
}


include 'includes/footer.php';
