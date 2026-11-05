<?php

if (isset($_GET['new'])) {
    require_once "views/newPost.phtml";
    exit;
}

if (isset($_GET['create'])) {
    if (isset($_POST['caption']) && !empty($_FILES['image']['name'])) {
        // actualizar bd -> guardar el post
        $newPostId = PostRepository::addPost($_SESSION['user']->getId(), $_POST['caption']);

        // subir la imagen
        $destiny = FileHelper::uploadFile($_FILES['image']['tmp_name'], $_FILES['image']['name'], $newPostId);

        PostRepository::updateImage($newPostId, $destiny);
    }
}