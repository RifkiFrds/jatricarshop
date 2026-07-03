<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AdminController;

$router = new Router();

// Customer Routes
$router->get('', [HomeController::class, 'index']);
$router->get('cars', [HomeController::class, 'cars']);
$router->get('cars/{id}', [HomeController::class, 'detail']);
$router->post('book', [HomeController::class, 'book']);

// Customer login route (can remain or redirect to subdomain if needed)
$router->get('login', [AdminController::class, 'login']);
$router->post('login', [AdminController::class, 'authenticate']);

return $router;
