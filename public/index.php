<?php


require_once __DIR__ . '/../vendor/autoload.php';

// Load routes and dispatch
require_once __DIR__ . '/../routes/web.php';

use core\ErrorHandler ; 

ErrorHandler::register() ;


