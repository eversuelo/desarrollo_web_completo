<?php include 'includes/header.php';
declare(strict_types=1);
/*Pueden ser: void int array boolean float string, el ? significa retorno opcional*/
/* el | nos ayuda a retornar basado en dierentes condiciones*/
function usuarioAutenticado(bool $autenticado): string | int {
    if($autenticado){
    return "El usuario esta autenticado";
    }else{
        return "El usuario no esta autenticado";
    }
}
$usuario=usuarioAutenticado(true);
echo $usuario. "<br>";



include 'includes/footer.php';