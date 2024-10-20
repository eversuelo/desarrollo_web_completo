<?php

namespace App;

class Propiedad extends ActiveRecord
{
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
    protected static $tabla = 'propiedades';
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $estacionamiento;
    public $creado;
    public $vendorId;
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
        /*  $this->vendedorId = $args['vendedorId'] ?? 1; */
    }
    public function validar()
    {
        if (empty($this->titulo)) {
            self::$errores[] = "Debes de añadir un titulo";
        }

        if (empty($this->precio)) {
            self::$errores[] = "Debes de añadir un precio";
        }

        if (strlen($this->descripcion) < 30) {
            self::$errores[] = "Debes de añadir un descripcion con almenos 30 caracteres";
        }
        if (empty($this->habitaciones)) {
            self::$errores[] = "Debes de añadir un numero de habitaciones";
        }
        if (empty($this->wc)) {
            self::$errores[] = "Debes de añadir un numero de baños";
        }
        if (empty($this->estacionamiento)) {
            self::$errores[] = "Debes de añadir un numero de estacionamiento";
        }
        if (empty($this->vendedorId)) {
            self::$errores[] = "Debes de añadir un vendedor";
        }
        if (empty($this->imagen)) {
            self::$errores[] = "Debes de añadir una imagen";
        }

        return self::$errores;
    }
}
