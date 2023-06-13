<?php
if (!empty($_POST)) {
    $auth = new \Core\Auth\DBAuth(\App\App::getInstance()->getDB());
    if ($auth->login($_POST['username'], $_POST['password'])) {
        \header('Location:admin.php');
    } else {
        ?>
            <div class="alert alert-danger">Indentifiants incorrect</div>
        <?php
    }
}
$form = new \Core\HTML\BootstrapForm($_POST);
?>

<form method="post">
    <?= $form->input('username', 'Pseudo'); ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
    <button class="btn btn-primary mt-3">Envoyer</button>
</form>
