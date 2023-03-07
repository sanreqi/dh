<?php
/* @var $model */
use \common\models\WqBlacklist;
$this->title = '围棋黑名单';
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="wq-blacklist-modal-label">开狗黑名单</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="wq-blacklist-form">
                <div class="form-group row">
                    <label for="platform" class="col-sm-3 col-form-label">平台</label>
                    <div class="col-sm-9">
                        <select name="platform" class="form-control" id="platform">
                            <?php foreach (WqBlacklist::getPlatformList() as $k => $v): ?>
                                <option value="<?php echo $k; ?>" <?php echo !empty($model)&&$model->platform==$k ? 'selected':'' ?>><?= $v; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type" class="col-sm-3 col-form-label">类型</label>
                    <div class="col-sm-9">
                        <select name="type" class="form-control" id="type">
                            <?php foreach (WqBlacklist::getTypeList() as $k => $v): ?>
                                <option value="<?php echo $k; ?>" <?php echo !empty($model)&&$model->type==$k ? 'selected':'' ?>><?= $v; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">用户名</label>
                    <div class="col-sm-9">
                        <input name="username" type="text" class="form-control" id="username"
                               value="<?php echo !empty($model) ? $model->username : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role-data" class="col-sm-3 col-form-label">备注</label>
                    <div class="col-sm-9">
                        <textarea name="description" rows="4" class="form-control" id="description"><?php echo !empty($model) ? $model->description : '' ?></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="save-wq-blacklist-btn">保存</button>
        </div>
    </div>
</div>

