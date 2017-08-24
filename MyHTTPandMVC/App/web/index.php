<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Router;
use Silex\Application;
use App\Config\MySQLConnector;

$connector = new MySQLConnector();
$app = new Application();
$router = new Router($app, $connector);
$app->mount('/', $router->home());
header('Content-Type: application/json');

$app->run();
