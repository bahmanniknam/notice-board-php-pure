<?php
ob_start();

require "../vendor/autoload.php";

use Bahman\NoticeBoard\Repositories\Notice;

$notice = new Notice();
$notice->title = $_POST['title'];
$notice->content = $_POST['content'];
$notice->user_id = $_POST['user_id'];
$notice->create();

header("Location: index.php");

