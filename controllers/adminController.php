<?php

// solo admin y owner pueden entrar
if (!isset($_SESSION['user']) || !$_SESSION['user']->hasAdminAccess()) {
    header("Location: index.php");
    exit;
}

$currentUser = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['deletePost'])) {
        PostRepository::deletePost((int) ($_POST['id'] ?? 0));
    }

    if (isset($_GET['deleteComment'])) {
        CommentRepository::deleteComment((int) ($_POST['id'] ?? 0));
    }

    if (isset($_GET['deleteUser'])) {
        $targetId = (int) ($_POST['id'] ?? 0);
        foreach (UserRepository::getAllUsers() as $target) {
            if ($target->getId() != $targetId) {
                continue;
            }
            // nadie se borra a si mismo ni al owner;
            // el admin solo borra usuarios normales, el owner tambien admins
            $allowed = $target->getId() != $currentUser->getId()
                && !$target->isOwner()
                && ($target->getRol() === 'user' || $currentUser->isOwner());
            if ($allowed) {
                UserRepository::deleteUser($targetId);
            }
        }
    }

    header("Location: index.php?c=admin");
    exit;
}

require_once "views/admin.phtml";
exit;
