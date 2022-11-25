<?php
ob_start();

require "../vendor/autoload.php";

use Bahman\NoticeBoard\Repositories\Notice;
use Bahman\NoticeBoard\Repositories\User;

try {
    $notice = (new Notice())->findOrFail($_GET['id']);
} catch (Exception $e) {
    header("Location: errors/404.php?message=".$e->getMessage());
}
?>

<?php include 'partials/navbar.php'; ?>

<div class="row">

    <div class="container-fluid text-right bg-light rounded-top  border-bottom" dir="rtl">
        <div class="col-lg-12 margin-tb">
            <div  class="p-3">
                <a href="index.php">
                    <i class="fas fa-arrow-right fa-lg"></i>
                </a>
                <h4 class="text-center">نمایش اعلان</h4>
            </div>
        </div>
    </div>
    <div class="text-right bg-light rounded" dir="rtl">
        <div class="row mx-auto p-4">
            <div class="col-xs-12 col-sm-12 col-md-12 ">
                <div class="form-group">
                    <strong>عنوان :</strong>
                    <?= $notice->title ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>توضیحات :</strong>
                    <?= $notice->content ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>گیرنده :</strong>
                    <?= $notice->name ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>تاریخ ارسال :</strong>
                    <?= $notice->time ?>
                </div>
            </div>
        </div>

</div>



