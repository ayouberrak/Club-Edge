<?php

use App\Controllers\ArticlesController;
use App\Controllers\EtudiantController;
use App\Controllers\AdminController;
use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ClubController;
use App\Controllers\DashboardController;
use App\Controllers\EventController;

$router = new Router();

// Public Routes
$router->get('/', [HomeController::class, 'index']);
$router->get('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'postRegister']);
$router->post('/login', [AuthController::class, 'postLogin']);
$router->get('/logout', [AuthController::class, 'logout']);

// Club Routes
$router->get('/club/{id}', [ClubController::class, 'show']);


// Dashboard Routes
$router->get('/dashboard', [DashboardController::class, 'index']); // Student Overview
$router->get('/dashboard/events', [DashboardController::class, 'studentEvents']);
$router->get('/dashboard/articles', [DashboardController::class, 'studentArticles']);

// President Routes
$router->get('/dashboard/president', [DashboardController::class, 'president']);
$router->get('/dashboard/president/events', [EventController::class, 'index']);
$router->get('/dashboard/president/articles', [DashboardController::class, 'presidentArticles']);
$router->post('/dashboard/president/articles', [ArticlesController::class, 'createArticle']);
$router->get('/dashboard/president/articles/success', [ArticlesController::class, 'articleSuccess']);
$router->get('/dashboard/president/articles/failure', [ArticlesController::class, 'articleFailure']);

// Admin Routes
$router->get('/dashboard/admin', [AdminController::class, 'admin']);
$router->get('/dashboard/admin/students', [DashboardController::class, 'adminStudents']);
$router->get('/dashboard/admin/logs', [DashboardController::class, 'adminLogs']);
$router->get('/dashboard/admin/club/{id}', [DashboardController::class, 'adminClubDetails']);
$router->get('/dashboard/admin/student/delete/{id}', [AdminController::class, 'deleteStudent']);

// Club Management (Admin)
$router->post('/dashboard/admin/club/create', [AdminController::class, 'createClub']);
$router->get('/dashboard/admin/club/delete/{id}', [AdminController::class, 'deleteclub']);
$router->get('/dashboard/admin/club/edit/{id}', [AdminController::class, 'modifierclub']);
$router->post('/dashboard/admin/club/update', [AdminController::class, 'clubaupdate']);

// Global Actions
$router->post('/events/store', [EventController::class, 'store']);
$router->get('/club/{id}', [ClubController::class, 'show']);

$router->dispatch();
