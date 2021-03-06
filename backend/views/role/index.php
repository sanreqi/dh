<?php
/* @var $this \yii\web\View */
/* @var $search */
/* @var $pages */

$this->title = 'ROLE';
?>

<div class="modal fade" id="role-modal" tabindex="-1" aria-labelledby="role-modal-label" aria-hidden="true">

</div>

<form class="form-row align-items-center">
    <div class="col-auto">
        <input type="text" class="form-control mb-2" name="name" value="" placeholder="角色名称">
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
                    <td><a href="<?php echo \yii\helpers\Url::toRoute(['/permission/index', 'role' => $model['name']]) ?>"><?= $model['name'] ?></a></td>
                    <td><?= $model['description'] ?></td>
                    <td><?= date('Y-m-d', $model['created_at']) ?></td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-role-btn" prikey-val="<?= $model['name']; ?>">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-role-btn" prikey-val="<?= $model['name']; ?>" str="<?= $model['name']; ?>">删除</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div>
    <?= \common\widgets\DhLinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>

<script>
    $(document).ready(function () {
        createModalBind("role");
        updateModalBind("role", "name");
        saveModalBind("role");
        deleteModalBind("role", "name");
    });
</script>