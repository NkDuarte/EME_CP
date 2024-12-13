<?php

//! Importaciones de recursos
use App\Router;
use App\Controllers\SuppliersController;
use App\Controllers\ProductsController;
use App\Models\Products;

//? -> Instancia de rutas
$router = new Router();

/**********************/
// ? -> URL Controladores Proveedor
$router->add('POST', '/suppliers/store', function() {
    $controller = new SuppliersController();
    $controller->store(); 
});

$router->add('PUT', '/suppliers/update/{id}', function($id) {
    $controller = new SuppliersController();
    $controller->update($id);  // Función para actualizar el proveedor
});

$router->add('GET', '/suppliers/view-unique/{id}', function($id) {
    $controller = new SuppliersController();
    $controller->unique_view_id($id);
});

$router->add('GET', '/suppliers/view-all', function() {
    $controller = new SuppliersController();
    $controller->view_all();
});

$router->add('DELETE', '/suppliers/delete/{id}', function($id) {
    $controller = new SuppliersController();
    $controller->delete($id);
});

/**********************/
/**********************/
//? -> URL Controladores Productos
$router->add('GET', '/products/view-unique/{id}', function($id) {
    $controller = new ProductsController();
    $controller->unique_view_id($id);
});

$router->add('POST', '/products/store', function() {
    $controller = new ProductsController();
    $controller->store();
});

$router->add('PUT', '/products/update/{id}', function($id) {
    $controller = new ProductsController();
    $controller->update($id);  // Función para actualizar el proveedor
});

$router->add('DELETE', '/products/delete/{id}', function($id) {
    $controller = new Products();
    $controller->delete($id);
});
/**********************/
