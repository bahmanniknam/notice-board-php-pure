<?php

ob_start();

require "../vendor/autoload.php";

use Bahman\NoticeBoard\Repositories\Notice;

if (empty($_POST["title"]) || empty($_POST["content"]) ||empty($_POST["user_id"]) ) {
    $errMsg = "Error! All fields is required.";
    header("Location: errors/404.php?message=" . $errMsg);
} else {
    $notice = new Notice();
    $notice->title = $_POST['title'];
    $notice->content = $_POST['content'];
    $notice->user_id = $_POST['user_id'];
    $notice->create();

    header("Location: index.php");
}

