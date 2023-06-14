<?php

namespace App\Controller;

class WelcomeController extends Controller
{

    public function welcome()
    {
        echo $this->twig->render('welcome.twig', [
            'isConnect' => $this->connexion->isConnect(),
            'isAdmin' => $this->connexion->isAdmin(),
            'name' => $_SESSION['member']['name'] ?? '',
            'countCommentInvalid' => $this->comment->countInvalidComment()[0]
        ]);
    }
}
