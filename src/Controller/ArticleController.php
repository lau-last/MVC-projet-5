<?php


namespace App\Controller;

use App\Model\ArticleModel;

class ArticleController extends Controller
{

    private ArticleModel $article;

    public function __construct()
    {
        parent::__construct();
        $this->article = new ArticleModel();
    }

    public function showArticles(): void
    {
        echo $this->twig->render('articles.twig', [
            'articles' => $this->article->getArticles(),
            'isConnect' => $this->connexion->isConnect(),
            'isAdmin' => $this->connexion->isAdmin(),
            'countCommentInvalid' => $this->comment->countInvalidComment()[0]
        ]);


    }

    public function showArticle($id): void
    {
        echo $this->twig->render('article.twig', [
            'article' => $this->article->getArticle($id),
            'comments' => $this->comment->getCommentByArticle($id),
            'isConnect' => $this->connexion->isConnect(),
            'isAdmin' => $this->connexion->isAdmin(),
            'countCommentInvalid' => $this->comment->countInvalidComment()[0]
        ]);
    }

    public function showArticleCreation(array $input, string $user_id): void
    {
        if (!empty($input)) {
            $title = $input['title'];
            $head = $input['head'];
            $content = $input['content'];
            $this->article->createArticle($title, $head, $content, $user_id);
            header("Location: articles");
            exit();
        } else {
            echo $this->twig->render('article-creation.twig', [
            'isConnect' => $this->connexion->isConnect(),
            'isAdmin' => $this->connexion->isAdmin(),
            'countCommentInvalid' => $this->comment->countInvalidComment()[0]
        ]);
        }
    }

    public function showCreateArticle(): void
    {
        echo $this->twig->render('article-gestion.twig', [
            'articles' => $this->article->getArticles(),
            'isConnect' => $this->connexion->isConnect(),
            'isAdmin' => $this->connexion->isAdmin(),
            'countCommentInvalid' => $this->comment->countInvalidComment()[0]
        ]);
    }

    public function showDeleteArticle($id): void
    {
        $this->article->deleteArticle($id);
        header("Location: article-gestion");
        exit();

    }

    public function showEditArticle(array $input, $user_id, $id)
    {
        if (!empty($input)) {
            $title = $input['title'];
            $head = $input['head'];
            $content = $input['content'];
            $this->article->editArticle($title, $head, $content, $user_id, $id);
            header("Location: article-gestion");
            exit();
        } else {
            $article = new ArticleModel();
            echo $this->twig->render('article-edit.twig', [
                'article' => $article->getEditArticle($id),
                'isConnect' => $this->connexion->isConnect(),
                'isAdmin' => $this->connexion->isAdmin(),
                'countCommentInvalid' => $this->comment->countInvalidComment()[0]
            ]);
        }
    }
}



