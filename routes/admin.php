<?php

use App\Core\Router;
use App\Controllers\AdminController;

$router = new Router();

// Admin Routes (Directly mapped, no '/admin' prefix needed on URL routing pattern)
$router->get('dashboard', [AdminController::class, 'dashboard']);
$router->get('logout', [AdminController::class, 'logout']);

// Admin Cars CRUD Routes
$router->get('cars', [AdminController::class, 'cars']);
$router->get('cars/create', [AdminController::class, 'createCar']);
$router->post('cars/create', [AdminController::class, 'storeCar']);
$router->get('cars/edit/{id}', [AdminController::class, 'editCar']);
$router->post('cars/edit/{id}', [AdminController::class, 'updateCar']);
$router->post('cars/delete/{id}', [AdminController::class, 'deleteCar']);

// Admin Orders Routes
$router->get('orders', [AdminController::class, 'orders']);
$router->post('orders/status/{id}', [AdminController::class, 'updateOrderStatus']);
$router->post('orders/delete/{id}', [AdminController::class, 'deleteOrder']);

return $router;
