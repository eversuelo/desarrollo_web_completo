<?php
//Conectar a la Base de Datos
require 'includes/app.php';

$db = conectarDB();
//Errores
$errores = [];
//Autenticar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //      echo "<pre>";
    //  var_dump($_POST);
    //  echo "</pre>";
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if (empty($email)) {
        $errores[] = "El email es obligatorio o no es valido";
    }
    if (empty($password)) {
        $errores[] = "El password es obligatorio o no es valido";
    }
    if(empty($errores)){
        //Revisar si el usuario existe
        $query="SELECT * FROM usuarios WHERE email='${email}'";
        $resultado=mysqli_query($db,$query);
        
        if($resultado->num_rows){
            //Revisar si el password es correcto
            $usuario=mysqli_fetch_assoc($resultado);
            //Verificar si el password es correcto
            
            $auth=password_verify($password,$usuario['password']);
    
            if($auth){
                session_start();
                //El usuario esta autenticado
                //LLenar el arrego de la Session
                $_SESSION['usuario']=$usuario['email'];
                $_SESSION['login']=true;
                header('Location:/admin/');
            }else{
                $errores[]="El password es incorrecto";
            }

        }else{
            $errores[]="El usuario no existe";
        }
    }

        // var_dump($errores);
    
}
//Incluye el Header

incluirTemplates('header', $inicio = false);

?>
<main class="contenedor">
    <h1>Iniciar Session</h1>
    <?php foreach ($errores as $error) : ?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form method="POST" class="formulario contenido-centrado">
        <fieldset>
            <legend>Email y Password</legend>


            <label for="email">email</label>
            <input type="email" name="email" id="email" placeholder="email Propiedad" required>

            <label for="password">Password</label>
            <input name="password" type="password" id="password" placeholder="Tu Password" required>

        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
    </form>
</main>
<?php
incluirTemplates('footer');
?>