<?php include 'includes/header.php';

//WHile
$i = 0; //Inicializador

while ($i < 10) {
    echo $i . "<br>";
    $i++; //Incremento
}
//Do While
$i = 10;
do {
    echo $i . "<br>";
    $i--; //Incremento

} while ($i > 0);

//For Loop
for ($i = 0; $i < 16; $i++) {
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo $i . "fizzz-Buzz<br>";
    } else if ($i % 3 == 0) {
        echo $i . "-Buzz<br>";
    } else if ($i % 5 == 0) {
        echo $i . "fizz<br>";
    }
}

echo "<h1> Nuevo Inicio </h1>";
//For Each
$clientes =array('Pedro','Juan','Pablo');
foreach($clientes as $cliente){
    echo $cliente ."<br>";
}
echo count($clientes)."<br>";
echo sizeof($clientes)."<br>";
//For each con arreglo asociativo
$cliente=[
    'nombre'=>'Juan',
    'saldo'=>200,
    'tipo'=>'Premium'
];

foreach($cliente as $key=> $valor):
    echo $key."-".$valor."<br>";
endforeach;

include 'includes/footer.php';
