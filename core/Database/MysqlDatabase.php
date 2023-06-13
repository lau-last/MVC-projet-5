<?php

namespace Core\Database;

use PDO;

class MysqlDatabase extends Database
{
    private string $db_name;
    private string $db_user;
    private string $db_pass;
    private string $db_host;
    private ?PDO $pdo = null;

    public function __construct(string $db_name, string $db_user = 'root', string $db_pass = 'root', string $db_host = 'localhost:8889')
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    private function getPDO(): ?PDO
    {
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:dbname=grafikart_blog;host=localhost:8889', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query(string $statement, ?string $className = null, bool $one = false)
    {
        $res = $this->getPDO()->query($statement);
        if(
            \strpos($statement, 'UPDATE') === 0 ||
            \strpos($statement, 'INSERT') === 0 ||
            \strpos($statement, 'DELETE') === 0
        ){
            return $res;
        }
        if ($className === null) {
            $res->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $res->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $className);
        }
        if ($one) {
            return $res->fetch();
        } else {
            return $res->fetchAll();
        }
    }

    public function prepare(string $statement, array $attributes, string $className = null, bool $one = false)
    {
        $res = $this->getPDO()->prepare($statement);
        $req = $res->execute($attributes);
        if (
            \strpos($statement, 'UPDATE') === 0 ||
            \strpos($statement, 'INSERT') === 0 ||
            \strpos($statement, 'DELETE') === 0
        ){
            return $req;
        }
        if ($className === null) {
            $res->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $res->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $className);
        }
        if ($one) {
            return $res->fetch();
        } else {
            return $res->fetchAll();
        }

    }

    public function lastInsertId(){
        return $this->getPDO()->lastInsertId();
    }
}