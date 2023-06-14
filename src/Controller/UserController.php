<?php

namespace App\Controller;

use App\Model\UserModel;

class UserController extends Controller
{

    private UserModel $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = new UserModel();
    }

    public function createUser($input)
    {
        if (!empty($_POST)) {
            $name = $input['name'];
            $password = md5($input['password']);
            $email = $input['email'];
            $this->user->inscription($name, $password, $email);
            header("Location: connexion");
        } else {
            echo $this->twig->render('inscription.twig', [
                'isConnect' => $this->connexion->isConnect(),
                'isAdmin' => $this->connexion->isAdmin(),
                'countCommentInvalid' => $this->comment->countInvalidComment()[0]
            ]);
        }
    }

    public function connexion()
    {
        echo $this->twig->render('connexion.twig', [
            'isConnect' => $this->connexion->isConnect(),
            'isAdmin' => $this->connexion->isAdmin(),
            'countCommentInvalid' => $this->comment->countInvalidComment()[0]
        ]);
    }

    public function showUser()
    {
        echo $this->twig->render('user-gestion.twig', [
            'users' => $this->user->getUser(),
            'isConnect' => $this->connexion->isConnect(),
            'isAdmin' => $this->connexion->isAdmin(),
            'countCommentInvalid' => $this->comment->countInvalidComment()[0]
        ]);
    }

    public function setUser($id)
    {
        $this->user->setUserUser($id);
        header('Location: user-gestion');
    }

    public function setAdmin($id)
    {
        $this->user->setUserAdmin($id);
        header('Location: user-gestion');
    }

    public function deleteUser($id)
    {
        $this->user->delete($id);
        header('Location: user-gestion');
    }

}


