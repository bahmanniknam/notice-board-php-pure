<?php
ob_start();

require "../vendor/autoload.php";

use Bahman\NoticeBoard\Repositories\Notice;

try {
    $notice = (new Notice())->findOrFail($_GET['id']);
} catch (Exception $e) {
    header("Location: errors/404.php?message=".$e->getMessage());
}

$notice->id = $_GET['id'];
$notice->delete();

header("Location: index.php");

