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

if(isset($_POST['submit'])) {
    $notice->title = $_POST['title'];
    $notice->content = $_POST['content'];
    $notice->user_id = $_POST['user_id'];
    $notice->update();

    header("Location: index.php");
}

$users = (new User())->all();
?>

<?php include 'partials/navbar.php'; ?>

<div class="row">

    <div class="container-fluid text-right bg-light rounded-top  border-bottom" dir="rtl">
        <div class="col-lg-12 ">
            <div class="p-3">
                <a href="index.php" >
                    <i class="fas fa-arrow-right   fa-lg"></i>
                </a>
                <h4 class="text-center">ویرایش اعلان</h4>
            </div>
        </div>
    </div>
    <form class="text-right bg-light rounded" dir="rtl" action="edit.php?id=<?= $notice->id ?>" method="POST">
        <div class="row p-5">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong class="p-3">عنوان :</strong>
                    <input type="text" name="title" value="<?= $notice->title ?>" class="form-control mt-2"
                           placeholder="عنوان" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 ">
                <div class="form-group">
                    <strong class="mt-3">توضیحات :</strong>
                    <textarea type="text" style="height:100px" class="form-control mt-2" name="content" id="content" rows="3"
                              placeholder="توضیحات" required><?= $notice->content ?></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <select class="custom-select" name="user_id" id="inlineFormCustomSelect" autocomplete="off"
                        style="height:30px" required>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->id ?>" required <?php if($user->id == $notice->user_id) echo 'selected'; ?>><?= $user->name ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-5">
                <button type="submit" class="btn btn-success" name="submit">ویرایش</button>
            </div>
        </div>

    </form>

</div>


