<?php include 'includes/header.php';
//Conectar a la BD con PDO
$db=new PDO('mysql:host=localhost:3499; dbname=bienes_raices','ever','3499');

$query="SELECT titulo, imagen FROM propiedades";
$stmt=$db->prepare($query);
//Lo Ejecuamos
$stmt->execute();
//Obtener los resultados
$resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);

//Iterar
foreach($resultado as $propiedad):
    echo $propiedad['titulo'];
    echo "<br>";
    echo $propiedad['imagen'];
    echo "<br>";
endforeach;

include 'includes/footer.php';