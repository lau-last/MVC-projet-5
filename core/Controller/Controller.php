<?php

namespace Core\Controller;

abstract class Controller
{
    protected string $viewPath;
    protected string $template;

    protected function render($view, ?array $data = [])
    {
        \ob_start();
        \extract($data);
        require $this->viewPath . \str_replace('.', '/', $view) . '.php';
        $content = \ob_get_clean();
        require $this->viewPath . 'templates/' . $this->template . '.php';
    }

    protected function forbidden()
    {
        \header('HTTP/1.0 403 Forbidden');
        die('Acces interdit');
    }

    protected function notFound()
    {
        \header('HTTP/1.0 404 Not found');
        die('Page introuvable');
    }
}