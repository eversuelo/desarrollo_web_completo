<?php include 'includes/header.php';

$cliente=[
    'nombre'=>"Juan",
    'saldo'=>200,
    'informacion'=>[
        'tipo'=>'Premium',
        'disponible'=>100
    ]
];
echo "<pre>";
var_dump($cliente['informacion']['tipo']);
echo "</pre>";
$cliente['codigo']=56465644646;

echo "<pre>";
var_dump($cliente);
echo "</pre>";

include 'includes/footer.php';