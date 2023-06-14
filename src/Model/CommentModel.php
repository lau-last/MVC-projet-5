<?php

namespace App\Model;

use App\database\DBConnexion;
use PDO;

class CommentModel
{

    public function getCommentByArticle($article_id)
    {
        $statement = DBConnexion::getDbConnect()->prepare("SELECT comment.id, comment.content, comment.date, comment.article_id, user.name FROM comment INNER JOIN user ON comment.user_id = user.id WHERE comment.article_id = :article_id AND comment.validation = 'valid' ORDER BY comment.date DESC");
        $statement->bindParam(":article_id", $article_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createComment($content, $user_id, $article_id): bool
    {
        $statement = DBConnexion::getDbConnect()->prepare("INSERT INTO comment (content, date, user_id, article_id) VALUES (:content, CURRENT_TIME, :user_id, :article_id)");
        $statement->bindParam(":content", $content);
        $statement->bindParam(":user_id", $user_id);
        $statement->bindParam(":article_id", $article_id);
        return $statement->execute();
    }

    public function getCommentsInvalid()
    {
        $statement = DBConnexion::getDbConnect()->prepare("SELECT comment.id, comment.content, comment.date, comment.validation, comment.article_id, user.name FROM comment INNER JOIN user ON comment.user_id = user.id ORDER BY comment.date DESC");
        //AND comment.validation = 'invalid'
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function passToValid($id)
    {
        $statement = DBConnexion::getDbConnect()->prepare("UPDATE comment SET validation = 'valid' WHERE comment.id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function passToInvalid($id)
    {
        $statement = DBConnexion::getDbConnect()->prepare("UPDATE comment SET validation = 'invalid' WHERE comment.id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function deleteComment($id)
    {
        $statement = DBConnexion::getDbConnect()->prepare("DELETE FROM comment WHERE comment.id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function countInvalidComment()
    {
        $statement = DBConnexion::getDbConnect()->prepare("SELECT COUNT(*) FROM comment WHERE comment.validation = 'invalid'");
        $statement->execute();
        return $statement->fetch(PDO::FETCH_NUM);
    }

}

