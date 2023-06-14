<?php

namespace App\Model;

use App\database\DBConnexion;
use PDO;

class UserModel
{

    public function inscription($name, $password, $email): bool
    {
        $statement = DBConnexion::getDbConnect()->prepare("INSERT INTO user (name, password, email) VALUES (:name, :password, :email)");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":email", $email);
        return $statement->execute();
    }

    public function getUserInfo($email)
    {
        $statement = DBConnexion::getDbConnect()->prepare("SELECT * FROM user WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        return $statement->fetch(PDO::PARAM_STR);
    }

    public function getUser()
    {
        $statement = DBConnexion::getDbConnect()->prepare("SELECT * FROM user");
        $statement->execute();
        return $statement->fetchAll(PDO::PARAM_STR);
    }

    public function setUserUser($id)
    {
        $statement = DBConnexion::getDbConnect()->prepare("UPDATE user SET role = 'user' WHERE user.id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function setUserAdmin($id)
    {
        $statement = DBConnexion::getDbConnect()->prepare("UPDATE user SET role = 'admin' WHERE user.id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function delete($id)
    {
        $statement = DBConnexion::getDbConnect()->prepare("DELETE FROM user WHERE user.id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

}
