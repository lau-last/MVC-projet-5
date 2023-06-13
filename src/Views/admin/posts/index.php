<?php
$posts = \App\App::getInstance()->getTable(\App\Table\PostTable::class)->all();
?>
<h1>Administrer les articles</h1>

<p>
    <a href="?page=posts.add" class="btn btn-success">Ajouter</a>
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
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= $post->getId(); ?></td>
            <td><?= $post->getTitre(); ?></td>
            <td>
                <a class="btn btn-primary" href="?page=posts.edit&id=<?= $post->getId(); ?>">Modifier</a>
                <form action="?page=posts.delete" method="post" style="display: inline">
                    <input type="hidden" name="id" value="<?= $post->id ?>">
                    <button type="submit" class="btn btn-danger" href="?page=posts.edit&id=<?= $post->getId(); ?>">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


