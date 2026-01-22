<?php

use Core\ErrorHandler;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('SRC_PATH' , dirname(__DIR__)); 

$envFile = __DIR__ . '/../.env';
require_once __DIR__ . '/../vendor/autoload.php';

if (file_exists($envFile)) {
    $env = parse_ini_file($envFile);

    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
    }
}

/*  ErrorHandler::register() ; */

// Load routes and dispatch
require_once __DIR__ . '/../routes/web.php';




