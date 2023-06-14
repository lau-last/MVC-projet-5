<?php

namespace App\admin;

use App\Model\UserModel;

class Connexion
{
    private UserModel $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function registerSession(): void
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $info = $this->user->getUserInfo($email);

            if (md5($password) == $info['password']) {
                $_SESSION['member'] = array();
                $_SESSION['member']['id'] = $info['id'];
                $_SESSION['member']['name'] = $info['name'];
                $_SESSION['member']['email'] = $info['email'];
                $_SESSION['member']['role'] = $info['role'];
            }
        }
    }

    public function isConnect(): bool
    {
        if (!empty($_SESSION['member'])) {
            return true;
        }
        return false;
    }

    public function isAdmin(): bool
    {
        if ($this->isConnect() && $_SESSION['member']['role'] === 'admin'){
            return true;
        }
        return false;
    }

}
