<?php

//? -> Cargar del autoloader
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/web.php';

//! Importacion de controladores
use App\Controllers\HomeController;
use App\Controllers\SuppliersController;
use App\Controllers\ProductsController;

//* Obtener la ruta actual
$requestUri = $_SERVER['REQUEST_URI'];

$router->dispatch($requestUri);

switch ($requestUri) {
    case '/':
        $controller = new HomeController();
        $controller->index();
        break;

    case '/suppliers':
        $controller = new SuppliersController();
        $controller->index();
        break;

    case '/products':
        $controller = new ProductsController();
        $controller->index();
        break;
    default:
        break;
}
