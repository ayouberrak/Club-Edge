<?php

require_once __DIR__ .'/../core/helpers.php';

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
define('BASE_URL', '/coachPro_v3');
$router = new Router();

require_once __DIR__ . '/../routes/web.php';

$router->dispatch();


