<?php
ob_start();

require "../vendor/autoload.php";

use Bahman\NoticeBoard\Repositories\Notice;
use Bahman\NoticeBoard\Repositories\User;

$notices = (new Notice())->all();
$users = (new User())->all();

?>

<?php include 'partials/navbar.php'; ?>

<div class="row">

    <!-- Button trigger modal -->
    <div class="pb-5">
        <button type="button" class="btn btn-light btn-lg float-right font-weight-light" data-toggle="modal"
                data-target="#newModal"><i class="fas fa-plus-circle"></i> اعلان جدید
        </button>
    </div>
    <div style="text-align: center">

        <table class="table  table-responsive-md-lg table-light " dir="rtl">
            <thead class="thead-light  text-center">
            <tr>
                <th scope="col">شناسه</th>
                <th scope="col">عنوان</th>
                <th scope="col">متن اعلان</th>
                <th scope="col">تاریخ</th>
                <th scope="col">گیرنده</th>
                <th scope="col">ویرایش</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($notices as $notice): ?>
            <tr>
                <td scope="row"><?php echo $notice->id ?></td>
                <td><?php echo $notice->title ?></td>
                <td><?php echo $notice->content ?></td>
                <td><?php echo $notice->time ?></td>
                <td><?php echo $notice->name ?></td>
                <td>
                    <a href="show.php?id=<?= $notice->id ?>">V
                        <i class="fas fa-eye text-success  fa-lg"></i>
                    </a>
                    <a href="edit.php?id=<?= $notice->id ?>">E
                        <i class="fas fa-edit text-secondary"></i>
                    </a>
                    <a href="delete.php?id=<?= $notice->id ?>">D
                        <i class="fas fa-trash fa-lg text-danger"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
             </tbody>
        </table>

    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="newModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!--Create Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title float-right">اعلان جدید</h4>
            </div>
            <div class="modal-body">
                <form dir="rtl" action="create.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp"
                               placeholder="عنوان " required>
                    </div>
                    <div class="form-group">
                            <textarea type="text" class="form-control" name="content" id="content" rows="3"
                                      placeholder="توضیحات" required></textarea>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="user_id" id="inlineFormCustomSelect" autocomplete="off"
                                style="height:30px" required>
                            <option value="" required>گیرنده</option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user->id ?>" required><?= $user->name ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="col col btn btn-danger p-1" data-dismiss="modal">بستن</button>
                        <button type="reset" class="col btn btn-Warning p-1">ریست</button>
                        <button type="submit" class="col btn btn-success p-1">ثبت</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>


