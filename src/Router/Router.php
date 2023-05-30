<?php

namespace App\Router;

class Router
{
    private array $routes;
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function match()
    {
        $url = $_GET['url'];

        if (array_key_exists($url, $this->routes)) {
            $action = $this->routes[$url];
            $action();
        } else {
            header('HTTP/1.0 404 Not Found');
            die();
        }
    }
}