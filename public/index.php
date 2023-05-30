<?php

session_start();

ini_set('display_errors', 'On');

require_once '../vendor/autoload.php';

define('ROOT', dirname(__DIR__));

(new App\admin\Connexion())->registerSession();

$routes = require_once ROOT . '/config/routes.php';

(new \App\Router\Router($routes))->match();