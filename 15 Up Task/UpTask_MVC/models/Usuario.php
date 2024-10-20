<?php

namespace Model;

class Usuario extends ActiveRecord
{
    /**Se añaden las propiedades a partir de php 8 */
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $token;
    public $confirmado;
    public $usuario;
    /**Se añaden las propiedades a partir de php 8 */
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }
    public function validarNuevaCuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del Usuario es Obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El email del Usuario es Obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password del Usuario es Obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe de tener al menos 6 caracteres';
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Los Passwords Son Diferentes';
        }
        return self::$alertas;
    }
    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    //Generar un Token
    public function crearToken()
    {
        $this->token = uniqid();
    }
    public function validarEmail()
    {
        if (empty($this->email)) {
            self::$alertas['error'][] = 'El email es Obligatorio';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email No es valido';
        }
        return self::$alertas;
    }
    public function validarPassword()
    {
        if (!$this->password) {
            self::$alertas['error'][] = 'El password del Usuario es Obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe de tener al menos 6 caracteres';
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Los Passwords Son Diferentes';
        }
        return self::$alertas;
    }
    public function validarLogin()
    {
        if (empty($this->email)) {
            self::$alertas['error'][] = 'El email es Obligatorio';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email No es valido';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password del Usuario es Obligatorio';
        }
        return self::$alertas;
    }
}
