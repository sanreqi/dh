<?php
/* @var $this \yii\web\View */
/* @var $pages */

$this->title = 'USER';
?>

<div class="modal fade" id="user-modal" tabindex="-1" aria-labelledby="user-modal-label" aria-hidden="true">

</div>

<form class="form-row align-items-center">
    <div class="col-auto">
        <input type="text" class="form-control mb-2" name="username" placeholder="用户名">
    </div>
    <div class="col-auto">
        <input type="text" class="form-control mb-2" name="truename" placeholder="姓名">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-2">搜索</button>
    </div>
    <div class="col-auto">
        <a id="create-user-btn" class="btn btn-primary mb-2">创建</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>用户名</th>
                <th>姓名</th>
                <th>手机号</th>
                <th>邮箱</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($models)): ?>
                <?php foreach ($models as $model): ?>
                    <tr>
                        <td><?= $model['username'] ?></td>
                        <td><?= $model['truename'] ?></td>
                        <td><?= $model['mobile'] ?></td>
                        <td><?= $model['email'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="text-right">
    <?= \common\widgets\DhLinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>



<script>
    $(document).ready(function () {
        $("body").on("click", "#save-user-btn", function () {
            $.ajax({
                type: "post",
                url: "/user/create",
                data: $("form").serializeArray(),
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        // $("#user-modal").html(data.data.html).modal();
                    } else {
                        dhAlert(data.errorMsg)
                    }
                }
            });
        });

        $("body").on("click", "#create-user-btn", function () {
            $.ajax({
                type: "get",
                url: "/user/create-modal",
                data: {},
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        $("#user-modal").html(data.data.html).modal();
                    }
                }
            });
        });
    });
</script>

