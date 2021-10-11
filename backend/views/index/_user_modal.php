<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="user-modal-label">用户表单</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">用户名</label>
                    <div class="col-sm-10">
                        <input name="user[username]" type="text" readonly class="form-control-plaintext" id="username"
                               value="<?php echo !empty($model) ? $model->username : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="truename" class="col-sm-2 col-form-label">姓名</label>
                    <div class="col-sm-10">
                        <input name="user[truename]" type="text" readonly class="form-control-plaintext" id="truename"
                               value="<?php echo !empty($model) ? $model->truename : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">密码</label>
                    <div class="col-sm-10">
                        <input name="user[password]" type="password" class="form-control" id="password">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>