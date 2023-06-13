<?php
$postTable = \App\App::getInstance()->getTable(\App\Table\PostTable::class);
if (!empty($_POST)) {
    $result = $postTable->delete($_POST['id']);
    header('Location: admin.php');
}

