<?php
$category = \App\App::getInstance()->getTable(\App\Table\CategoryTable::class);
if (!empty($_POST)) {
    $result = $category->delete($_POST['id']);
    header('Location: admin.php?page=categories.index');
}

