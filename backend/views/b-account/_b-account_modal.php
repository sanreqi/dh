<?php
/* @var $model \common\models\BAccount */
$this->title = '账户';
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="b-account-modal-label">账户</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="b-account-form">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">账户名称</label>
                    <div class="col-sm-9">
                        <input name="name" type="text" class="form-control" id="name"
                               value="<?php echo !empty($model) ? $model->name : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="account" class="col-sm-3 col-form-label">账户号</label>
                    <div class="col-sm-9">
                        <input name="account" type="text" class="form-control" id="account"
                               value="<?php echo !empty($model) ? $model->account : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-3 col-form-label">余额</label>
                    <div class="col-sm-9">
                        <input name="amount" type="text" class="form-control" id="amount"
                               value="<?php echo !empty($model) ? $model->amount : '' ?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="save-b-account-btn">保存</button>
        </div>
    </div>
</div>

