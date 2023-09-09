<?php

namespace Model;

class Vendedor extends ActiveRecord
{
    protected static $tabla='vendedores';
    protected static $columnasDB = ['id', 'nombre','apellido','telefono'];
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
      
        /*  $this->vendedorId = $args['vendedorId'] ?? 1; */
    }
    public function validar()
    {
        if (empty($this->nombre)) {
            self::$errores[] = "Debes de añadir un nombre";
        }

        if (empty($this->apellido)) {
            self::$errores[] = "Debes de añadir un apellido";
        }

        if (empty($this->telefono) || strlen($this->telefono)<10) {
            self::$errores[] = "Debes de añadir un telefono con almenos 10 caracteres";
        }
        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = "Formato de teléfono no válido";
        }

        return self::$errores;
    }
}
