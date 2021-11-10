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
                    <label for="username" class="col-sm-3 col-form-label">用户名</label>
                    <div class="col-sm-9">
                        <input name="UserForm[username]" type="text" class="form-control" id="username"
                               value="<?php echo !empty($model) ? $model->username : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="truename" class="col-sm-3 col-form-label">姓名</label>
                    <div class="col-sm-9">
                        <input name="UserForm[truename]" type="text" class="form-control" id="truename"
                               value="<?php echo !empty($model) ? $model->truename : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mobile" class="col-sm-3 col-form-label">手机号</label>
                    <div class="col-sm-9">
                        <input name="UserForm[mobile]" type="text" class="form-control" id="mobile"
                               value="<?php echo !empty($model) ? $model->mobile : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">邮箱</label>
                    <div class="col-sm-9">
                        <input name="UserForm[email]" type="text" class="form-control" id="email"
                        value="<?php echo !empty($model) ? $model->email : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">密码</label>
                    <div class="col-sm-9">
                        <input name="UserForm[password]" type="password" class="form-control" id="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirmPassword" class="col-sm-3 col-form-label">确认密码</label>
                    <div class="col-sm-9">
                        <input name="UserForm[confirmPassword]" type="password" class="form-control" id="confirmPassword">
                    </div>
                </div>
                <input name="UserForm[id]" type="hidden" value="<?php echo !empty($model) ? $model->id : ''; ?>">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="save-user-btn" url="">保存</button>
        </div>
    </div>
</div>

