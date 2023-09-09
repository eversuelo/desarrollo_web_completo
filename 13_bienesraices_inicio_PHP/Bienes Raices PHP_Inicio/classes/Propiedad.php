<?php

namespace App;

class Propiedad
{
    //Base de Datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
    protected static $errores = [];
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $estacionamiento;
    public $creado;
    public $vendorId;
    //Definir la conexion a la BD
    public static function setDB($database)
    {
        self::$db = $database;
    }
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }
    public function guardar()
    {
        $atributos = $this->sanitizarAtributos();

        //Insetar en la base de datos
        $query = "INSERT INTO propiedades(";
        $query .= join(',', array_keys($atributos));
        $query .= ") VALUES('";
        $query .= join("','", array_values($atributos));
        $query .= "')";

        $resultado = self::$db->query($query);
        return $resultado;
    }
    //Indetificar y uir los atributos de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    

    public static function getErrores()
    {
        return self::$errores;
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
    //Subida de Archivos
    public function setImagen($imagen)
    {
            //Asignar el atributo a la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }
    //Lista todas las Propiedades
    public static function all(){
        echo "Enlistando las Propiedades";
        $query="SELECT * FROM propiedades";
        $resultado=self::consultarSQL($query);
        return $resultado;
    }
    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado=self::$db->query($query);
        //Iterar los resultados
        $array=[]; 
        while($registo=$resultado->fetch_assoc()){
            $array[]=self::crearObjeto($registo);
        }  

        //Liberar la memoria
        $resultado->free();
        //retornar los resultados
        return $array;
    }
    protected static function  crearObjeto($registro){
        $objeto=new self;
        foreach($registro as $key => $value){
            if(property_exists($objeto,$key)){
$objeto->$key=$value;
            }
        }
        return $objeto;
    }
}
