<?php

use App\Controllers\ArticlesController;
use App\Controllers\EtudiantController;
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

$router->get('/dashboard/president/events', [DashboardController::class, 'presidentEvents']);

$router->get('/dashboard/president/events', [EventController::class, 'index']);
$router->post('/dashboard/president/events', [ArticlesController::class, 'createArticle']);

$router->get('/dashboard/president/articles/success', [ArticlesController::class, 'articleSuccess']);
$router->get('/dashboard/president/articles/failure', [ArticlesController::class, 'articleFailure']);


$router->get('/dashboard/president', [DashboardController::class, 'president']); // President Members
$router->get('/dashboard/president', [EtudiantController::class, 'index']); // President Members


/* creer un evenement */
$router->post('/events/store', [EventController::class, 'store']);
$router->get('/dashboard/president/articles', [DashboardController::class, 'presidentArticles']);

$router->get('/dashboard/admin', [DashboardController::class, 'admin']); // Admin Clubs
$router->get('/dashboard/admin/students', [DashboardController::class, 'adminStudents']);
$router->get('/dashboard/admin/logs', [DashboardController::class, 'adminLogs']);
$router->get('/dashboard/admin/club/{id}', [DashboardController::class, 'adminClubDetails']);

/* test recuperation detaills de club */
$router->get('/dashboard/admin/club', [ClubController::class, 'testClubDetails']);
$router->dispatch();
