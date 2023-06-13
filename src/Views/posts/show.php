<?php

$app = \App\App::getInstance();
$post = $app->getTable(\App\Table\PostTable::class)->findWithCategory($_GET['id']);
if ($post === false) {
    $app->notFound();
}
//$app->getTitre() = $post->getTitre();

?>

<h1><?= $post->getTitre(); ?></h1>

<p><em><?= $post->categorie; ?></em></p>

<p><?= $post->getContenu(); ?></p>
