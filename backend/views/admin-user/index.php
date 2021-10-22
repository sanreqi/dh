<?php
/* @var $this \yii\web\View */
/* @var $search */
/* @var $pages */

$this->title = 'USER';
?>

<div class="modal fade" id="user-modal" tabindex="-1" aria-labelledby="user-modal-label" aria-hidden="true">

</div>

<form class="form-row align-items-center">
    <div class="col-auto">
        <input type="text" class="form-control mb-2" name="username" value="<?= $search['username'] ?>" placeholder="用户名">
    </div>
    <div class="col-auto">
        <input type="text" class="form-control mb-2" name="truename" value="<?= $search['truename'] ?>" placeholder="姓名">
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
                <th>操作</th>
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
                        <td>
                            <a href="javascript:void(0)" class="btn-sm btn-success update-user-btn" userid="<?= $model['id'] ?>" username="<?= $model['username'] ?>">编辑</a>
                            <a href="javascript:void(0)" class="btn-sm btn-danger delete-user-btn" userid="<?= $model['id'] ?>" username="<?= $model['username'] ?>">删除</a>
                        </td>
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
            var $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            $.ajax({
                type: "post",
                url: "/admin-user/save-admin-user",
                data: $("#user-form").serializeArray(),
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        window.location.reload();
                    } else {
                        dhAlert(data.errorMsg)
                    }
                },
                complete: function (data) {
                    $this.prop("disabled", false).removeClass("disabled");
                }
            });
        });

        $("body").on("click", "#create-user-btn", function () {
            $.ajax({
                type: "get",
                url: "/admin-user/create-modal",
                data: {},
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        $("#user-modal").html(data.data.html).modal();
                    }
                }
            });
        });

        $("body").on("click", ".update-user-btn", function () {
            var id = $(this).attr("userid");
            $.ajax({
                type: "get",
                url: "/admin-user/update-modal",
                data: {
                    "id": id
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        $("#user-modal").html(data.data.html).modal();
                    }
                }
            });
        });

        $("body").on("click", ".delete-user-btn", function () {
            var $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            var id = $this.attr("userid");
            var username = $this.attr("username");
            dhConfirm("确定要删除用户" + username + "吗？");

            $("#dh-confirm").find("#dh-confirm-btn").click(function() {
                $.ajax({
                    type: "post",
                    url: "/admin-user/delete-admin-user",
                    data: {
                        "id": id
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 1) {
                            window.location.reload();
                        } else {
                            dhAlert(data.errorMsg)
                        }
                    },
                    complete: function (data) {
                        $this.prop("disabled", false).removeClass("disabled");
                    }
                });
            });
        });
    });
</script>

