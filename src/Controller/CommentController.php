<?php

namespace App\Controller;


class CommentController extends Controller
{

    public function showCreateComment($article_id, $input)
    {
        $content = $input['comment'];
        $user_id = $_SESSION['member']['id'];
        $this->comment->createComment($content, $user_id, $article_id);
        header('Location: index.php?url=article&id=' . $article_id);
        exit();
    }

    public function showInvalidComments()
    {
        echo $this->twig->render('comment-gestion.twig', [
            'comments' => $this->comment->getCommentsInvalid(),
            'isConnect' => $this->connexion->isConnect(),
            'isAdmin' => $this->connexion->isAdmin(),
            'countCommentInvalid' => $this->comment->countInvalidComment()[0]
        ]);
    }

    public function setValidComment($id)
    {
        $this->comment->passToValid($id);
        header("Location: comment-gestion");
        exit();
    }

    public function setInvalidComment($id)
    {
        $this->comment->passToInvalid($id);
        header("Location: comment-gestion");
        exit();
    }


    public function setDeleteComment($id)
    {
        $this->comment->deleteComment($id);
        header("Location: comment-gestion");
        exit();
    }

}
