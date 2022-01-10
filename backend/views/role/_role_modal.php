<?php
/* @var $model */
/* @var $title */
/* @var $url */
/* @var $parent */
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="role-modal-label"><?= $title ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <form id="role-form">
                <div class="form-group row">
                    <label for="role-name" class="col-sm-3 col-form-label">名称</label>
                    <div class="col-sm-9">
                        <input <?php echo !empty($model) ? 'readonly' : ''; ?> name="RoleForm[name]" type="text" class="form-control" id="role-name"
                               value="<?php echo !empty($model) ? $model->name : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role-description" class="col-sm-3 col-form-label">描述</label>
                    <div class="col-sm-9">
                        <input name="RoleForm[description]" type="text" class="form-control" id="role-description"
                               value="<?php echo !empty($model) ? $model->description : '' ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role-rule-name" class="col-sm-3 col-form-label">上级角色</label>
                    <div class="col-sm-9">
                        <select name="RoleForm[parent_role]" class="form-control" id="role-rule-name">
                            <option value=""></option>
                            <?php if (!empty($parent_roles)): ?>
                                <?php foreach ($parent_roles as $role): ?>
                                    <?php $selected = $parent==$role ? 'selected' : ''; ?>
                                    <option <?= $selected ?> value="<?= $role ?>"><?= $role ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

<!--                <div class="form-group row">-->
<!--                    <label for="role-rule-name" class="col-sm-3 col-form-label">规则名称</label>-->
<!--                    <div class="col-sm-9">-->
<!--                        <select name="RoleForm[ruleName]" class="form-control" id="role-rule-name">-->
<!--                        </select>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="form-group row">-->
<!--                    <label for="role-data" class="col-sm-3 col-form-label">数据</label>-->
<!--                    <div class="col-sm-9">-->
<!--                        <textarea name="RoleForm[data]" rows="4" class="form-control" id="role-data"-->
<!--                               value="--><?php //echo !empty($model) ? $model->data : '' ?><!--">-->
<!--                        </textarea>-->
<!--                    </div>-->
<!--                </div>-->
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" id="save-role-btn">保存</button>
        </div>
    </div>
</div>

