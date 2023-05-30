<?php


return [
    'index.php' => function () {
        (new App\Controller\WelcomeController())->welcome();
    },
    '' => function () {
        (new App\Controller\WelcomeController())->welcome();
    },
    'articles' => function () {
        (new App\Controller\ArticleController())->showArticles();
    },
    'article' => function () {
        $id = $_GET['id'];
        (new App\Controller\ArticleController())->showArticle($id);
    },
    'inscription' => function () {
        (new \App\admin\Connexion())->isConnect() ?
            header("Location: index.php") :
            (new App\Controller\UserController())->createUser($_POST);
    },
    'connexion' => function () {
        (new \App\admin\Connexion())->isConnect() ?
            header("Location: index.php") :
            (new App\Controller\UserController())->connexion();
    },
    'create-comment' => function () {
        if ((new \App\admin\Connexion())->isConnect()) {
            $article_id = $_GET['id'];
            (new App\Controller\CommentController())->showCreateComment($article_id, $_POST);
        } else {
            header("Location: index.php");
            exit();
        }
    },
    'article-creation' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
            $user_id = intval($_SESSION['member']['id']);
            (new App\Controller\ArticleController())->showArticleCreation($_POST, $user_id);
        } else {
            header("Location: index.php");
            exit();
        }
    },
    'article-gestion' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
            (new App\Controller\ArticleController())->showCreateArticle();
        } else {
            header("Location: index.php");
            exit();
        }
    },
    'edit-article' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
            $id = $_GET['id'];
            $user_id = intval($_SESSION['member']['id']);
            (new App\Controller\ArticleController())->showEditArticle($_POST, $user_id, $id);
        } else {
            header("Location: index.php");
            exit();
        }
    },
    'delete-article' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
            $id = $_GET['id'];
            (new App\Controller\ArticleController())->showDeleteArticle($id);
        } else {
            header("Location: index.php");
            exit();
        }
    },
    'comment-gestion' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
            (new App\Controller\CommentController())->showInvalidComments();
        } else {
            header("Location: index.php");
            exit();
        }
    },
    'comment-valid' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
            $id = $_GET['id'];
            (new App\Controller\CommentController())->setValidComment($id);
        } else {
            header("Location: index.php");
            exit();
        }
    },
    'delete-comment' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
            $id = $_GET['id'];
            (new App\Controller\CommentController())->setDeleteComment($id);
        } else {
            header("Location: index.php");
            exit();
        }
    },
    'comment-invalid' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
            $id = $_GET['id'];
            (new App\Controller\CommentController())->setInvalidComment($id);
        } else {
            header("Location: index.php");
            exit();
        }
    },
    'user-gestion' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
            (new App\Controller\UserController())->showUser();
        } else {
            header("Location: index.php");
            exit();
        }
    },
    'user-user' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
            $id = $_GET['id'];
            (new \App\Controller\UserController())->setUser($id);
        }else {
            header("Location: index.php");
            exit();
        }
    },
    'user-admin' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
        $id = $_GET['id'];
        (new \App\Controller\UserController())->setAdmin($id);
        }else {
            header("Location: index.php");
            exit();
        }
    },
    'delete-user' => function () {
        if ((new \App\admin\Connexion())->isAdmin() && (new \App\admin\Connexion())->isConnect()) {
        $id = $_GET['id'];
        (new \App\Controller\UserController())->deleteUser($id);
        }else {
            header("Location: index.php");
            exit();
        }
    },
    'deconnexion' => function () {
        session_destroy();
        header("Location: index.php");
        exit();
    }
];