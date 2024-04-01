<?php

namespace App;

use App\Controllers\Controller;
use App\Controllers\NotFoundController;

/**
 * @var Router $router
 */
$router->get('/', [Controller::class, 'query']);

$router->post('/hello', [Controller::class, 'hello']);

$router->get('404', [NotFoundController::class, 'get']);