<?php
$table = \App\App::getInstance()->getTable(\App\Table\CategoryTable::class);
if (!empty($_POST)) {
    $result = $table->update($_GET['id'], [
        'titre' => $_POST['titre']
    ]);
    if ($result) {
        ?>
        <div class="alert alert-success">L'article a bien été Modifier</div>
        <?php
    };
}
$categorie = $table->find($_GET['id']);
$form = new \Core\HTML\BootstrapForm($categorie)
?>

<form method="post">
    <?= $form->input('titre', 'Titre de la catégorie'); ?>
    <button class="btn btn-primary mt-3">Sauvegarder</button>
</form>
