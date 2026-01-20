<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


define('SRC_PATH' , dirname(__DIR__)); 

require_once __DIR__ . '/../vendor/autoload.php';

// Load routes and dispatch
require_once __DIR__ . '/../routes/web.php';


