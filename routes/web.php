<?php

use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ClubController;
use App\Controllers\DashboardController;

$router = new Router();

// Public Routes
$router->get('/', [HomeController::class, 'index']);
$router->get('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'register']);
$router->post('/login', [AuthController::class, 'postLogin']);
$router->get('/logout', [AuthController::class, 'logout']);

// Club Routes
$router->get('/club/{id}', [ClubController::class, 'show']);

// Dashboard Routes
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/dashboard/president', [DashboardController::class, 'president']);
$router->get('/dashboard/admin', [DashboardController::class, 'admin']);

$router->post('/dashboard/club/create', [DashboardController::class, 'createClub']);

$router->dispatch();
