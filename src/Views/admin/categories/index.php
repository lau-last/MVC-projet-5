<?php
$categories = \App\App::getInstance()->getTable(\App\Table\CategoryTable::class)->all();
?>
<h1>Administrer les catégories</h1>

<p>
    <a href="?page=categories.add" class="btn btn-success">Ajouter</a>
</p>

<table class="table">
    <thead>
    <tr>
        <td>ID</td>
        <td>Titre</td>
        <td>Actions</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= $category->getId(); ?></td>
            <td><?= $category->getTitre(); ?></td>
            <td>
                <a class="btn btn-primary" href="?page=categories.edit&id=<?= $category->getId(); ?>">Modifier</a>
                <form action="?page=categories.delete" method="post" style="display: inline">
                    <input type="hidden" name="id" value="<?= $category->id ?>">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


