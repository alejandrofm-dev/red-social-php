<?php

if (isset($_GET['add']) && isset($_SESSION['user']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = (int) ($_POST['post_id'] ?? 0);
    $comment = trim($_POST['comment'] ?? '');
    if ($postId > 0 && $comment !== '') {
        CommentRepository::addComment($postId, $_SESSION['user']->getId(), $comment);
    }
}

header("Location: index.php");
exit;
