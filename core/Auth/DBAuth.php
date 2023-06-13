<?php

namespace Core\Auth;

use Core\Database\MysqlDatabase;

class DBAuth
{
    private MysqlDatabase $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function getUserId()
    {
        if ($this->logged()) {
            return $_SESSION['auth'];
        }
        return false;
    }

    public function login($username, $password)
    {
        $user = $this->db->prepare('SELECT * FROM users WHERE username = ?', [$username], null, true);
        if ($user) {
            if ($user->password === \md5($password)) {
                $_SESSION['auth'] = $user->id;
                return true;
            }
        } else {
            return false;
        }
    }

    public function logged(): bool
    {
        return isset($_SESSION['auth']);
    }
}