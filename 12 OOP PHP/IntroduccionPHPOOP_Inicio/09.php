<?php include 'includes/header.php';
//Conectar a la BD con Mysqli

$db=new mysqli('localhost:3499','root','admin','bienes_raices');
//Creamo el Query
$query="SELECT titulo from propiedades";
// $resultado =$db->query($query);
// echo "<pre>";
//  while($row =$resultado->fetch_assoc()):
//     var_dump($row);
// endwhile;
//  echo "</pre>";


/*De otra fORMA*/
//Lo prepraramos
$stmt=$db->prepare($query);
//Lo ejecutamos
$stmt->execute();
//Creamos la variable
$stmt->bind_result($titulo);
//asignamos el resultado
$stmt->fetch();
//Imprimimos el Resultado
var_dump($titulo);
include 'includes/footer.php';