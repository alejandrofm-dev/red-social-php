<?php

if (isset($_GET['toggle']) && isset($_GET['post']) && isset($_SESSION['user'])) {
    LikeRepository::toggleLike((int) $_GET['post'], $_SESSION['user']->getId());
}

if (isset($_GET['toggleComment']) && isset($_GET['comment']) && isset($_SESSION['user'])) {
    LikeRepository::toggleCommentLike((int) $_GET['comment'], $_SESSION['user']->getId());
}

header("Location: index.php");
exit;
