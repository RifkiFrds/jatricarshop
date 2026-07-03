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

// Admin Routes
$router->get('login', [AdminController::class, 'login']);
$router->post('login', [AdminController::class, 'authenticate']);
$router->get('admin/dashboard', [AdminController::class, 'dashboard']);
$router->get('admin/logout', [AdminController::class, 'logout']);

// Admin Cars CRUD Routes
$router->get('admin/cars', [AdminController::class, 'cars']);
$router->get('admin/cars/create', [AdminController::class, 'createCar']);
$router->post('admin/cars/create', [AdminController::class, 'storeCar']);
$router->get('admin/cars/edit/{id}', [AdminController::class, 'editCar']);
$router->post('admin/cars/edit/{id}', [AdminController::class, 'updateCar']);
$router->post('admin/cars/delete/{id}', [AdminController::class, 'deleteCar']);

// Admin Orders Routes
$router->get('admin/orders', [AdminController::class, 'orders']);
$router->post('admin/orders/status/{id}', [AdminController::class, 'updateOrderStatus']);
$router->post('admin/orders/delete/{id}', [AdminController::class, 'deleteOrder']);

return $router;

