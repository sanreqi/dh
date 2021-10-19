<?php
/* @var $model */
/* @var $title */
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="page-modal-label"><?= $title ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <form id="page-form">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">页面名称</label>
                    <div class="col-sm-9">
                        <input name="PageForm[name]" type="text" class="form-control" id="name"
                               value="<?php echo !empty($model) ? $model->name : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">页面名称</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="4" name="PageForm[description]"
                        value="<?php echo !empty($model) ? $model->description : '' ?>"></textarea>
                    </div>
                </div>
                <input name="PageForm[id]" type="hidden" value="<?php echo !empty($model) ? $model->id : ''; ?>">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="save-page-btn">保存</button>
        </div>
    </div>
</div>

