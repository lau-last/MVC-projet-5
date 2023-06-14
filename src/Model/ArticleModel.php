<?php

namespace App\Model;

use App\database\DBConnexion;
use PDO;

class ArticleModel
{

    public function getArticles()
    {
        $statement = DBConnexion::getDbConnect()->prepare("SELECT article.id, article.title, article.head, article.content, article.date, user.name FROM article INNER JOIN user ON article.user_id = user.id ORDER BY article.date DESC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticle($id)
    {
        $statement = DBConnexion::getDbConnect()->prepare("SELECT article.id, article.title, article.head, article.content, article.date, user.name FROM article INNER JOIN user ON article.user_id = user.id WHERE article.id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createArticle($title, $head, $content, $user_id): bool
    {
        $statement = DBConnexion::getDbConnect()->prepare("INSERT INTO article (title, head, content, user_id) VALUES (:title, :head, :content, :user_id)");
        $statement->bindParam(":title", $title);
        $statement->bindParam(":head", $head);
        $statement->bindParam(":content", $content);
        $statement->bindParam(":user_id", $user_id);
        return $statement->execute();

    }

    public function deleteArticle($id): bool
    {
        $statement = DBConnexion::getDbConnect()->prepare("DELETE FROM article WHERE article.id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function editArticle($title, $head, $content, $user_id, $id): bool
    {
        $statement = DBConnexion::getDbConnect()->prepare("UPDATE article SET title = :title, head = :head, content = :content, date = NOW(), user_id = :user_id WHERE id = :id");
        $statement->bindParam(":title", $title);
        $statement->bindParam(":head", $head);
        $statement->bindParam(":content", $content);
        $statement->bindParam(":user_id", $user_id);
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getEditArticle($id)
    {
        $statement = DBConnexion::getDbConnect()->prepare("SELECT * FROM article WHERE article.id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
