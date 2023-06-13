<?php
$table = \App\App::getInstance()->getTable(\App\Table\CategoryTable::class);
if (!empty($_POST)) {
    $result = $table->creat([
        'titre' => $_POST['titre']
    ]);
    if ($result) {
        \header("Location:admin.php?page=categories.index");
    };
}
//$post = $postTable->find($_GET['id']);
$form = new \Core\HTML\BootstrapForm($_POST);
?>

<form method="post">
    <?= $form->input('titre', 'Titre de la catégorie'); ?>
    <button class="btn btn-primary mt-3">Sauvegarder</button>
</form>
