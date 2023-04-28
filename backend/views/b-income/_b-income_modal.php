<?php
/* @var $model \common\models\BAccount */
$this->title = '收入';
//\common\assets\DateTimePickerAsset::register($this);
?>

<?php $accountList = \common\services\BAccountService::findAllAccounts(); ?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="b-income-modal-label">收入</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="b-income-form">
                <div class="form-group row">
                    <label for="account_id" class="col-sm-3 col-form-label">账户名称</label>
                    <div class="col-sm-9">
                        <select name="account_id" id="account_id" class="form-control">
                            <option value="0">账户名</option>
                            <?php foreach ($accountList as $account): ?>
                                <?php $selected = !empty($model)&&$model['account_id']==$account['id'] ? 'selected' : ''; ?>
                                <option <?php echo $selected; ?> value="<?php echo $account['id'] ?>"><?php echo $account['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label">收入时间</label>
                    <div class="col-sm-9">
                        <input name="date" type="text" class="form-control" id="date"
                               value="<?php echo !empty($model) ? $model['date'] : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-3 col-form-label">收入金额</label>
                    <div class="col-sm-9">
                        <input name="amount" type="text" class="form-control" id="amount"
                               value="<?php echo !empty($model) ? $model['amount'] : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="balance" class="col-sm-3 col-form-label">账户余额</label>
                    <div class="col-sm-9">
                        <input name="balance" type="text" class="form-control" id="balance"
                               value="<?php echo !empty($model) ? $model['balance'] : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="remark" class="col-sm-3 col-form-label">备注</label>
                    <div class="col-sm-9">
                        <input name="remark" type="text" class="form-control" id="remark"
                               value="<?php echo !empty($model) ? $model['remark'] : '' ?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="save-b-income-btn">保存</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#date').datetimepicker({
            lang: 'ch',
            timepicker: false,
            format: 'Y-m-d',
        });
    });
</script>
