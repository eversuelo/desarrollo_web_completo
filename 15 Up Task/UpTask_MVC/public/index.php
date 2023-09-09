<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashboardController;
use Controllers\LoginController;
use MVC\Router;
$router = new Router();

$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);

$router->get('/crear',[LoginController::class,'crear']);
$router->post('/crear',[LoginController::class,'crear']);
//Olvide mi Password
$router->get('/olvide',[LoginController::class,'olvide']);
$router->post('/olvide',[LoginController::class,'olvide']);

$router->get('/restablecer',[LoginController::class,'restablecer']);
$router->post('/restablecer',[LoginController::class,'restablecer']);

$router->get('/mensaje',[LoginController::class,'mensaje']);
$router->get('/confirmar',[LoginController::class,'confirmar']);


//Zona de Proyectos
$router->get('/dashboard',[DashboardController::class,'index']);
$router->get('/crear-proyecto',[DashboardController::class,'crear_proyecto']);
$router->post('/crear-proyecto',[DashboardController::class,'crear_proyecto']);
$router->get('/perfil',[DashboardController::class,'perfil']);

$router->get('/proyecto',[DashboardController::class,'proyecto']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();