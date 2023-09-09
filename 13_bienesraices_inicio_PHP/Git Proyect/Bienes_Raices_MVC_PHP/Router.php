<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];
    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }
    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;
        //Arreglo de rutas protegidad..
        $rutas_protegidas = ['/admin', '/propiedades/crear', "/propiedades/actualizar", "/propiedades/eliminar", "/vendedores/eliminar", "/vendedores/crear", "/vendedores/actualizar"];
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
        $fn = NULL;
        if ($metodo === 'GET') {

            $fn = $this->rutasGET[$urlActual] ?? null;
        } else if ($metodo === 'POST') {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }
       
        if ($fn != NULL) {
            call_user_func($fn, $this);
        } else {
            echo 'Pagina No Encontrada =(';
/*             echo "Fn Value=" . $fn . "<br>" . $urlActual;
            echo "<pre>";
            var_dump($this->rutasGET);
            echo "</pre>";

            echo "<pre>";
            var_dump($this->rutasPOST);
            echo "</pre>"; */
        }
    }
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . '/views/' . $view . '.php';
        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";
    }
}
