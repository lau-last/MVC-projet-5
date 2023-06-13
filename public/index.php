<?php
session_start();
\error_reporting(E_ALL);
\ini_set('display_errors', 1);

require_once '../vendor/autoload.php';

\define('ROOT', \dirname(__DIR__));

$page = $_GET['page'] ?? 'home';

if ($page === 'home') {
    $controller = new \App\Controller\PostsController();
    $controller->index();
} elseif ($page === 'posts.categories') {
    $controller = new \App\Controller\PostsController();
    $controller->categories();
}elseif ($page === 'posts.show'){
    $controller = new \App\Controller\PostsController();
    $controller->show();
}elseif ($page === 'login'){
    $controller = new \App\Controller\UserController();
    $controller->login();
}

