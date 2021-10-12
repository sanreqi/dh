<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="user-modal-label">创建用户</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="user-form">
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">用户名</label>
                    <div class="col-sm-10">
                        <input name="User[username]" type="text" class="form-control" id="username"
                               value="<?php echo !empty($model) ? $model->username : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="truename" class="col-sm-2 col-form-label">姓名</label>
                    <div class="col-sm-10">
                        <input name="User[truename]" type="text" class="form-control" id="truename"
                               value="<?php echo !empty($model) ? $model->truename : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mobile" class="col-sm-2 col-form-label">手机号</label>
                    <div class="col-sm-10">
                        <input name="User[mobile]" type="text" class="form-control" id="mobile"
                               value="<?php echo !empty($model) ? $model->mobile : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">密码</label>
                    <div class="col-sm-10">
                        <input name="User[password]" type="password" class="form-control" id="password">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="save-user-btn">保存</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        abwc();

        $("body").on("click", "#save-user-btn", function () {
            $.ajax({
                type: "post",
                url: "/user/create",
                data: $("form").serializeArray(),
                dataType: "json",
                success: function(data){
                    if (data.status == 1) {
                        // $("#user-modal").html(data.data.html).modal();
                    } else {
                        alert(data.errorMsg);
                    }
                }
            });
        });
    });
</script>