<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Classes\Email;

class LoginController
{
    public static function login(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            if (empty($alertas)) {
                //Comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);
                if ($usuario) {
                    //Verificar el password
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        if ($usuario->admin === '1') {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location:/admin');
                        } else {
                            header('Location:/cita');
                        }
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }
    public static function logout()
    {
        session_start();
        $_SESSION=[];
        header('Location: /');
    }
    public static function olvide(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $auth->validarEmail();

            $auth = new Usuario($_POST);
            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                if ($usuario && $usuario->confirmado === '1') {
                    //Generar Token
                    $usuario->crearToken();
                    $usuario->guardar();
                    // Enviar el Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                    //Alerta de Exito
                    Usuario::setAlerta('exito', 'Revisa tu email');
                } else {
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                }
            }
            $alertas = Usuario::getAlertas();
        }

        $router->render('auth/olvide-password', ['alertas' => $alertas]);
    }
    public static function recuperar(Router $router)
    {
        $alertas = [];
        $token = null;
        $error = false;
        if (isset($_GET['token'])) {
            $token = s($_GET['token']);




            //Buscar Usuario por su token
            $usuario = Usuario::where('token', $token);
            if (empty($usuario)) {
                Usuario::setAlerta('error', 'Token No Valido');

                $error = true;
            }
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $password=new Usuario($_POST);
                $alertas=$password->validarPassword();
                if(empty($alertas)){
                    $usuario->password=null;
                    $usuario->password=$password->password;
                    $usuario->hashPassword();
                    $usuario->token=null;
                    $resultado=$usuario->guardar();
                    if($resultado){
                        header('Location:/');
                    }
                }
            }
        } else {
            $error = true;
            Usuario::setAlerta('error', 'Token No Valido');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [
            'alertas' => $alertas, 'error' => $error

        ]);
    }

    public static function crear(Router $router)
    {
        $usuario = new Usuario();
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            //Revisar que alertas este vacio
            if (empty($alertas)) {
                //Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();
                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    //No esta Registrado, Registrar
                    //Hashear el Password
                    $usuario->hashPassword();


                    $usuario->crearToken();
                    $email = new Email( $usuario->email,$usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        $alertas['exito'][] = "Tu cuenta se ha creado Correctamente";
                        header('Location:/mensaje');
                    } else {
                        $alertas['error'][] = "Ha Ocurrido un Error";
                    }
                }
            }
        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje', []);
    }
    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Valido');
        } else {
            $usuario->confirmado = "1";
            $usuario->token = "";
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta comprobada correctamente');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}
