<?php $this->title = 'ROLE'; ?>

<div class="modal fade" id="role-modal" tabindex="-1" aria-labelledby="role-modal-label" aria-hidden="true">

</div>

<form class="form-row align-items-center">
    <div class="col-auto">
        <input type="text" class="form-control mb-2" name="name" value="" placeholder="页面名称">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-2">搜索</button>
    </div>
    <div class="col-auto">
        <a id="create-role-btn" class="btn btn-primary mb-2">创建</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>名称</th>
            <th>描述</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $model): ?>
                <tr>
                    <td><?= $model->name ?></td>
                    <td><?= $model->description ?></td>
                    <td><?= date('Y-m-d', $model->createdAt) ?></td>
                    <td>
                        1
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        createModalBind("role");
        updateModalBind("role");

        $("body").on("click", "#save-role-btn", function () {
            var $this = $(this);
            var url = $("#save-url").val();
            $this.prop("disabled", "disabled").addClass("disabled");
            $.ajax({
                type: "post",
                url: url,
                data: $("#role-form").serializeArray(),
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
</script>