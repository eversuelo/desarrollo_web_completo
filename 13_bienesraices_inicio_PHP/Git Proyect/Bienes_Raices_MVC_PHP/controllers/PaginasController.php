<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index', ['propiedades' => $propiedades, 'inicio' => $inicio]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }
    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router)
    {
        $id = validarORedireccionarID('/');
        $propiedad = Propiedad::find($id);
        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router)
    {

        $router->render('paginas/blog', []);
    }
    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada', []);
    }
    public static function contacto(Router $router)
    {
        $mensaje=null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];

            $mail = new PHPMailer();
            //Configutar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'fa1e7d5b1bfa2f';
            $mail->Password = 'b2a835f357f4f4';
            $mail->SMTPSecure = 'tls';

            //Configurar el contenido del mail
            $mail->setFrom('sonidoemotions@sonido.com');
            $mail->addAddress('sonidoemotions@sonido.com', 'sonido.com');
            $mail->addAddress('everardo.03.04.99@gmail.com', 'sonido.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';



            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo Mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            //Enviar de forma condicional algunos campos de email o telefono
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligio ser contactado por telefono</p>';
                $contenido .= '<p>telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>fecha a ser contactado: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>La hora a ser contactado: ' . $respuestas['hora'] . '</p>';
            } else {
                $contenido .= '<p>Eligio ser contactado por email</p>';
                $contenido .= '<p>email: ' . $respuestas['email'] . '</p>';
            }
            $contenido .= '<p>mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>vende o compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';


            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = "Texto alternativo";
            if ($mail->send()) {
                $mensaje= "Mensaje enviado Correctamente";
            } else {
                $mensaje= "El mensajee no se pudo enviar";
            }
        }
        $router->render('paginas/contacto', ['mensaje'=>$mensaje]);
    }
}
