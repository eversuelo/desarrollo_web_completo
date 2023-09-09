<?php

namespace Classes;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    public function enviarConfirmacion()
    {
        //Crear el objeto  de email
        $mail = new PHPMailer();
        try {
            //Server settings
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'fa1e7d5b1bfa2f';
            $mail->Password = 'b2a835f357f4f4';                             //TCP port to connect to; use 587 if you have set `SMTPSecure = mail::ENCRYPTION_STARTTLS`

            $mail->setFrom('cuentas@appsalon.com');
            $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
            $mail->Subject = 'Confirma TU Cuenta';

            $contenido = "<html><p>Hola " . $this->nombre;
            $contenido .= "<strong> Has creado tu cuenta de App Salon, solo debes confirmalra presionando el siguiente enlace</strong>";
            $contenido .= "<p>Presiona a <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
            $contenido .= "</p><p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p></html>";
            $mail->Body = $contenido;
            $mail->send();

            echo 'Message has been sent';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    public function enviarInstrucciones()
    {
        //Crear el objeto  de email
        $mail = new PHPMailer();
        try {
            //Server settings
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'fa1e7d5b1bfa2f';
            $mail->Password = 'b2a835f357f4f4';                             //TCP port to connect to; use 587 if you have set `SMTPSecure = mail::ENCRYPTION_STARTTLS`

            $mail->setFrom('cuentas@appsalon.com');
            $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
            $mail->Subject = 'Restablece tu Password';

            $contenido = "<html><p>Hola " . $this->nombre;
            $contenido .= "<strong> Haz Solicitado restablecer tu password, sigue el siguiente enlace:</strong>";
            $contenido .= "<p>Presiona a <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Restablecer Cuenta</a></p>";
            $contenido .= "</p><p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p></html>";
            $mail->Body = $contenido;
            $mail->send();

            echo 'Message has been sent';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
