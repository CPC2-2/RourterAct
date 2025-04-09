<?php

require 'src/Router.php';
require 'src/Http/Request.php';
require 'src/helper.php';
require 'src/Http/Response.php';
require 'src/Controllers/UserController.php';

use Api\Router;
use Api\Http\Request;
use Api\Http\Response;
use Api\Controllers\UserController;

//flujo del programa 
$request2 = new Request();
$router = new Router($request2);

$router->addRoute('GET', '/', [new UserController($request2), 'index']);
$router->addRoute('GET', '/api/users', [new UserController($request2), 'index']);
$router->addRoute('GET', '/api/users/{id}', [new UserController($request2), 'show']);

$router->dispacth();
