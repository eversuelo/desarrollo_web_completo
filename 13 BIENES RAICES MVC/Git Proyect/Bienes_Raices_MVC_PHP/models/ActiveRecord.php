<?php

namespace Model;

use mysqli_sql_exception;

class ActiveRecord
{
    //Base de Datos
    protected static $db;
    protected static $columnasDB = [];

    protected static $tabla = '';

    protected static $errores = [];

    //Definir la conexion a la BD
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function guardar()
    {
        if (!is_null($this->id)) {
            // actualizar
            $this->actualizar();
        } else {
            $this->crear();
        }
    }
    public function crear()
    {
        $atributos = $this->sanitizarAtributos();

        //Insetar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(',', array_keys($atributos));
        $query .= ") VALUES('";
        $query .= join("','", array_values($atributos));
        $query .= "');";
        // echo "Guardando Query. " . $query;
        $resultado = self::$db->query($query);
        //mENSAJE De Exito
        if ($resultado) {
            //echo "Insertado Correctamente <br>";
            header('Location: /admin?resultado=1');
        } else {
            //echo "ERROR IncCorrectamente <br>";
        }
    }
    public function actualizar()
    {
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET " . join(',', $valores) . " WHERE id= '" . self::$db->escape_string($this->id) . "'  LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado) {
            //echo "Insertado Correctamente <br>";
            header('Location: /admin?resultado=2');
        } else {
            //  echo "ERROR IncCorrectamente <br>";
        }
    }
    //Eliminar un registro
    public function eliminar()
    {
        //Elimina la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id= " . self::$db->escape_string($this->id) . " LIMIT 1";

        try {
            $resultado = self::$db->query($query);
        } catch (mysqli_sql_exception $e) {
            if (!is_null($e))
                $resultado = 'resultado=4';
            header('location: /admin?' . $resultado);
        }
        if (static::$tabla == "propiedad") {
            if ($resultado) {
                debuguear($resultado);
                $this->borrarImagen();
                header('location: /admin?resultado=3');
            }
        }
        return $resultado;
    }
    //Indetificar y uir los atributos de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
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
    //Elimina Imagen
    public function borrarImagen()
    {
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen . ".jpg");
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen . ".jpg");
        }
    }

    public static function getErrores()
    {
        return static::$errores;
    }
    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }
    //Subida de Archivos
    public function setImagen($imagen)
    {
        //Elimina la imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        //Asignar el atributo a la imagen
        if ($imagen) {

            $this->imagen = $imagen;
        }
    }
    //Lista todas las Propiedades
    public static function all()
    {
        //echo "Enlistando las Propiedades";
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    //Busca un registro por Su ID
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id= ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
    public static function consultarSQL($query)
    {
        //Consultar la base de datos
        $resultado = self::$db->query($query);
        //Iterar los resultados
        $array = [];
        while ($registo = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registo);
        }

        //Liberar la memoria
        $resultado->free();
        //retornar los resultados
        return $array;
    }
    protected static function  crearObjeto($registro)
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
    public static function get($limit)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $limit; //Static hereda este método y busca en la clase em la cual se está llamando
        return self::consultarSQL($query);
    }
}
