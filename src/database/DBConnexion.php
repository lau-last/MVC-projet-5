<?php

namespace App\database;

use PDO;

class DBConnexion
{

    private static $pdo = null;

    public static function getDbConnect(): PDO
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO('mysql:host=localhost:8889;dbname=blog;charset=utf8', 'root', 'root');
        }
        return self::$pdo;
    }
}
