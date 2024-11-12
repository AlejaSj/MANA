<?php
require_once __DIR__ . '/../app/controllers/HomeController.php';

$controller = new HomeController();

$uri = $_SERVER['REQUEST_URI'];
if ($uri == '/MANA/home') {
    $controller->showLandingPage();
} elseif ($uri == '/MANA/api/getTips') {
    $controller->getEnvironmentalTips();
} elseif ($uri == '/MANA/api/submitForm' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->submitForm();
} else {
    // Ruta no encontrada
    echo json_encode(['error' => 'Ruta no encontrada']);
}
?>
