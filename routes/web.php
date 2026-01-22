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
use App\Controllers\AvisController;

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
$router->post('/club/join', [ClubController::class, 'joinClub']);
$router->post('/club/leave', [ClubController::class, 'leave']);


// Dashboard Routes
$router->get('/dashboard', [DashboardController::class, 'index']); // Student Overview

// President Routes
$router->get('/dashboard/president', [DashboardController::class, 'president']);
$router->post('/dashboard/president/articles', [ArticlesController::class, 'createArticle']);
$router->get('/dashboard/president/articles/success', [ArticlesController::class, 'articleSuccess']);
$router->get('/dashboard/president/articles/failure', [ArticlesController::class, 'articleFailure']);
$router->get('/dashboard/president/articles/delete/{id}', [ArticlesController::class, 'deleteArticle']);
$router->post('/dashboard/president/articles/edit', [ArticlesController::class, 'updateArticle']);

// Admin Routes
$router->get('/dashboard/admin', [AdminController::class, 'admin']);
$router->get('/dashboard/admin/club/{id}', [DashboardController::class, 'adminClubDetails']);
$router->get('/dashboard/admin/student/delete/{id}', [AdminController::class, 'deleteStudent']);

// Club Management (Admin)
$router->post('/dashboard/admin/club/create', [AdminController::class, 'createClub']);
$router->get('/dashboard/admin/club/delete/{id}', [AdminController::class, 'deleteclub']);
$router->get('/dashboard/admin/club/edit/{id}', [AdminController::class, 'modifierclub']);
$router->post('/dashboard/admin/club/update', [AdminController::class, 'clubaupdate']);

// Global Actions
$router->post('/events/store', [EventController::class, 'store']);
$router->post('/event/register', [EventController::class, 'register']);
$router->post('/event/cancel', [EventController::class, 'cancel']);
$router->post('/avis/add', [AvisController::class, 'addAvis']);

$router->dispatch();
