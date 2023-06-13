<?php
$postTable = \App\App::getInstance()->getTable(\App\Table\PostTable::class);
if (!empty($_POST)) {
    $result = $postTable->update($_GET['id'], [
        'titre' => $_POST['titre'],
        'contenu' => $_POST['contenu'],
        'categories_id' => $_POST['categories_id']
    ]);
    if ($result) {
        ?>
        <div class="alert alert-success">L'article a bien été Modifier</div>
        <?php
    };
}
$post = $postTable->find($_GET['id']);
$categories = \App\App::getInstance()->getTable(\App\Table\CategoryTable::class)->extract('id', 'titre');
$form = new \Core\HTML\BootstrapForm($post);
?>

<form method="post">
    <?= $form->input('titre', 'Titre le l\'article'); ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
    <?= $form->select('categories_id', 'Categorie', $categories); ?>
    <button class="btn btn-primary mt-3">Sauvegarder</button>
</form>
