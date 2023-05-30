<?php

namespace App\Controller;
use App\admin\Connexion;
use App\Model\CommentModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    private FilesystemLoader $loader;

    protected Environment $twig;
    protected Connexion $connexion;
    protected CommentModel $comment;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(ROOT . '/view');
        $this->twig = new Environment($this->loader, [
            'cache' => false,
        ]);
        $this->connexion = new Connexion();
        $this->comment = new CommentModel();
    }
}