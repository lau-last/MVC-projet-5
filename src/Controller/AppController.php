<?php

namespace App\Controller;

use Core\Controller\Controller;

class AppController extends Controller
{
    protected string $template = 'default';

    public function __construct()
    {
        $this->viewPath = ROOT . '/src/Views/';
    }

    protected function loadModel($modelName)
    {
        $this->$modelName = \App\App::getInstance()->getTable($modelName);
    }
}