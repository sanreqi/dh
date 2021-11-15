<?php
/* @var $uid */
/* @var $roles */
?>

<div class="card pr">
    <div class="card-body">
        <h5 class="card-title">用户角色</h5>
        <div id="role-content">
            <form id="role-form">
                <?php if (!empty($roles)): ?>
                    <?php foreach ($roles as $role): ?>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input name="roles[]" type="checkbox" <?= $role['checked']; ?> value="<?= $role['name'] ?>"
                                       class="controller-chx-item form-check-input" ?><?= $role['name']; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <input name="uid" type="hidden" value="<?= $uid; ?>">
            </form>
        </div>
    </div>
    <button type="button" class="card-edit-btn" id="save-role-btn">保存</button>
</div>