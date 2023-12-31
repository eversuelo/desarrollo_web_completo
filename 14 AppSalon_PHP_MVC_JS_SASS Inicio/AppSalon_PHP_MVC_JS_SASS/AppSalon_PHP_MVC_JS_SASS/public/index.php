<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\CitaController;
use MVC\Router;
use Controllers\LoginController;
$router = new Router();


//Iniciar Sesion
$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);

//Recuperar Password
$router->get('/olvide',[LoginController::class,'olvide']);
$router->post('/olvide',[LoginController::class,'olvide']);
$router->get('/recuperar',[LoginController::class,'recuperar']);
$router->post('/recuperar',[LoginController::class,'recuperar']);

//Crear Cuenta
$router->get('/crear-cuenta',[LoginController::class,'crear']);
$router->post('/crear-cuenta',[LoginController::class,'crear']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador


//Confirmar cuenta
$router->get('/confirmar-cuenta',[LoginController::class,'confirmar']);
$router->get('/mensaje',[LoginController::class,'mensaje']);
//Area Privada
$router->get('/cita',[CitaController::class,'index']);
//Area Privada
$router->get('/admin',[AdminController::class,'index']);
//API de Citas
$router->get('/api/servicios',[APIController::class,'index']);
$router->posT('/api/citas',[APIController::class,'guardar']);

//Comprueba y valida las rutas, que existian y las asigna, que existan  y las asigna funciones del controlador
$router->comprobarRutas();