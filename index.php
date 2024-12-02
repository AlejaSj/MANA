<?php
require_once 'config/conexionBD.php';
require_once __DIR__ . '/app/controllers/HomeController.php';
$controller = new HomeController();

$uri = $_SERVER['REQUEST_URI'];
if ($uri == '/MANA/' or $uri == '/mana/') {
    $controller->showLandingPage();
} elseif ($uri == '/MANA/public/layout/pages/form.html') {
    $controller->showFormPage();
} elseif ($uri == '/MANA/api/submitForm' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->submitForm();
} else {
    echo json_encode(['error' => 'Ruta no encontrada']);
}


?>
