<?php
/* @var $this \yii\web\View */
/* @var $search */
/* @var $pages */

$this->title = 'PAGE';
?>

<div class="modal fade" id="page-modal" tabindex="-1" aria-labelledby="page-modal-label" aria-hidden="true">

</div>

<form class="form-row align-items-center">
    <div class="col-auto">
        <input type="text" class="form-control mb-2" name="name" value="" placeholder="页面名称">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-2">搜索</button>
    </div>
    <div class="col-auto">
        <a id="create-page-btn" class="btn btn-primary mb-2">创建</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>id</th>
            <th>页面名称</th>
            <th>页面描述</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $model): ?>
                <tr>
                    <td><?= $model['id'] ?></td>
                    <td><?= $model['name'] ?></td>
                    <td><?= $model['description'] ?></td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-page-btn" page_id="<?= $model['id'] ?>" page_name="<?= $model['name'] ?>">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-page-btn" page_id="<?= $model['id'] ?>" page_name="<?= $model['name'] ?>">删除</a>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['page-content/index', 'page_id' => $model['id']]) ?>" target="_blank" class="btn-sm btn-warning">内容</a>
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
        $("body").on("click", "#save-page-btn", function () {
            var $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            $.ajax({
                type: "post",
                url: "/page/save-page",
                data: $("#page-form").serializeArray(),
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

        $("body").on("click", "#create-page-btn", function () {
            $.ajax({
                type: "get",
                url: "/page/create-modal",
                data: {},
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        $("#page-modal").html(data.data.html).modal();
                    }
                }
            });
        });

        $("body").on("click", ".update-page-btn", function () {
            var id = $(this).attr("page_id");
            $.ajax({
                type: "get",
                url: "/page/update-modal",
                data: {
                    "id": id
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        $("#page-modal").html(data.data.html).modal();
                    }
                }
            });
        });

        $("body").on("click", ".delete-page-btn", function () {
            var $this = $(this);
            $this.prop("disabled", "disabled").addClass("disabled");
            var id = $this.attr("page_id");
            var name = $this.attr("page_name");
            dhConfirm("确定要删除页面" + name + "吗？");

            $("#dh-confirm").find("#dh-confirm-btn").click(function() {
                $.ajax({
                    type: "post",
                    url: "/page/delete-page",
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

