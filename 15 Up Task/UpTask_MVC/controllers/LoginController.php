<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Classes\Email;

class LoginController
{
    public static function login(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarLogin();

            if (empty($alertas)) {
                //verificar que el usuario exista
                $usuario = Usuario::where('email', $usuario->email);
                if (!$usuario || !$usuario->confirmado) {
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                } else {
                    //El usuario Existe
                    session_start();
                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['nombre'] = $usuario->nombre;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['login'] = true;
                    
                    //Redirecionar
                    header('Location: /dashboard');
                    if (!password_verify($_POST['password'], $usuario->password)) {
                        Usuario::setAlerta('error', 'Password Incorrecto');
                    }
                }
            }
        }


        //Render a la vista
        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesion', 'alertas' => $alertas
        ]);
    }
    public static function logout(Router $router)
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
    public static function crear(Router $router)
    {
        $alertas = [];
        $usuario = new Usuario();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            if (empty($alertas)) {

                $existeUsuario = Usuario::where('email', $usuario->email);
                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'El usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    //Crear el usuario
                    //Hashear el pasword
                    $usuario->hashPassword();
                    unset($usuario->password2);
                    //Generar EL Toquen
                    $usuario->crearToken();
                    //Guardar
                    $resultado = $usuario->guardar();
                    //Enviar EMAIL
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }
        //Render a la vista
        $router->render('auth/crear', [
            'titulo' => 'crear',
            'usuario' => $usuario,
            'alertas' => $alertas

        ]);
    }
    public static function olvide(Router $router)
    {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();
            if (empty($alertas)) {
                //Buscar el Usuario
                $usuario = Usuario::where('email', $usuario->email);
                if ($usuario && $usuario->confirmado === '1') {
                    //Encontre al usuario
                    //Generar un nuevo token
                    $usuario->crearToken();

                    //Actualizar el usuario
                    $usuario->guardar();
                    //Enviar Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                    //Imprimir Alerta
                    Usuario::setAlerta('exito', "Hemos enviado las instrucciones a tu email");
                } else {
                    Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        //Render a la vista
        $router->render('auth/olvide', [
            'titulo' => 'olvide',
            'alertas' => $alertas

        ]);
    }
    public static function restablecer(Router $router)
    {
        $token = s($_GET['token']);
        $mostrar = true;
        if (empty($token)) header('Location:/');
        $usuario = Usuario::where('token', $token);
        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token No valido');
            $mostrar = false;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Añadir el nuevo password
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPassword();
            if (empty($alertas)) {
                //Hasehar el nuevo Password
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();
                if ($resultado) {
                    header('Location:/');
                }
            }
        }
        //Render a la vista
        $alertas = Usuario::getAlertas();
        $router->render('auth/restablecer', [
            'titulo' => 'restablecer',
            'alertas' => $alertas,
            'mostrar' => $mostrar

        ]);
    }
    public static function mensaje(Router $router)
    {
        //Render a la vista
        $router->render('auth/mensaje', [
            'titulo' => 'mensaje'

        ]);
    }
    public static function confirmar(Router $router)
    {
        $token = s($_GET['token']);
        if (!$token) header('Location:/');

        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            //No se encontro un usuario con ese token
            Usuario::setAlerta('error', 'Token no válido');
        } else {
            //Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($usuario->password2);
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }
        $alertas = Usuario::getAlertas();

        //Render a la vista
        $router->render('auth/confirmar', [
            'titulo' => 'confirmar',
            'alertas' => $alertas

        ]);
    }
}
