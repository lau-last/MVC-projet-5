<div class="row">
    <div class="col-sm-8">
        <?php foreach ($posts as $post): ?>

            <h2><a href="<?= $post->getUrl(); ?>"><?= $post->getTitre(); ?></a></h2>

            <p><em><?= $post->categorie; ?></em></p>

            <p><?= $post->getExtrait(); ?></p>

        <?php endforeach; ?>
    </div>
    <div class="col-sm-4">
        <?php foreach ($categories as $categorie): ?>
            <li><a href="<?= $categorie->getUrl(); ?>"><?= $categorie->getTitre(); ?></a></li>
        <?php endforeach; ?>
    </div>
</div>


