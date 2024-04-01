<?php

use App\Router;

$root = __DIR__ . '/..';

require $root . '/vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


echo Router::load($root . '/src/routes.php')->callRoute($uri, $method);
