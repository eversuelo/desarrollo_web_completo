<?php include 'includes/header.php';
declare(strict_types=1);
/*EL tipado nos ayudaa  asegurar que se tome el tipo de dato correcto*/
function sumar(int $numero1=0,int $numero2=0){
echo $numero1 + $numero2;
}
sumar(1,-3);
echo "<br>";





include 'includes/footer.php';