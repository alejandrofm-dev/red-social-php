<?php

require_once "models/Post.php";
require_once "models/Comment.php";
require_once "models/Like.php";
require_once "models/User.php";
require_once "repositories/PostRepository.php";
require_once "repositories/CommentRepository.php";
require_once "repositories/LikeRepository.php";
require_once "repositories/UserRepository.php";
require_once "helpers/FileHelper.php";

session_start();

// controladores
if (isset($_GET['c'])) {
    require_once "controllers/" . $_GET['c'] . "Controller.php";
    exit;
}

// ver login
if (isset($_GET['login'])) {
    require_once "views/login.phtml";
    exit;
}

// ver register
if (isset($_GET['register'])) {
    require_once "views/register.phtml";
    exit;
}

// vista default
require_once "views/home.phtml";