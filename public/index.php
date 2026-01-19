<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ .'/../core/helpers.php';

require_once __DIR__ . '/../vendor/autoload.php';

use core\Router;
use core\ErrorHandler ; 

ErrorHandler::register() ;

define('BASE_URL', '/Club-Edge');


$router = new Router();

require_once __DIR__ . '/../routes/web.php';
$testobj = new controller ; 

$router->dispatch();


