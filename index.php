<?php
require 'vendor/autoload.php';
require_once 'config/conexionBD.php';
require_once __DIR__ . '/app/controllers/HomeController.php';

$app = new Slim\App();
$app->get('/',function($request, $response, $args){
    ob_start(); 
    require __DIR__ . '/app/views/home.php';
    $phpContent = ob_get_clean(); 

    $response->getBody()->write($phpContent);

    return $response->withHeader('Content-Type', 'text/html');
});

$app->get('/form',function($request, $response, $args){
    ob_start(); 
    require __DIR__ . '/app/views/form.php';
    $phpContent = ob_get_clean(); 

    $response->getBody()->write($phpContent);

    return $response->withHeader('Content-Type', 'text/html');
});

$app->get('/administrador',function($request, $response, $args){
    ob_start(); 
    require __DIR__ . '/Admins/login.php';
    $phpContent = ob_get_clean(); 

    $response->getBody()->write($phpContent);

    return $response->withHeader('Content-Type', 'text/html');
});

$app->post('/administrador',function($request, $response, $args){
    ob_start(); 
    require __DIR__ . '/Admins/login.php';
    $phpContent = ob_get_clean(); 

    $response->getBody()->write($phpContent);

    return $response->withHeader('Content-Type', 'text/html');
});

$app->run();


if ($_SERVER['REQUEST_URI'] === '/MANA/api/submitForm' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/app/controllers/HomeController.php';
    $controller = new HomeController();
    $controller->submitForm();
}

?>