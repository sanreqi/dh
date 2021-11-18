<?php
/* @var $this \yii\web\View */
/* @var $search */
/* @var $pages */

$this->title = 'USER';
?>

<div class="modal fade" id="user-modal" tabindex="-1" aria-labelledby="user-modal-label" aria-hidden="true">

</div>

<form class="form-row align-items-center">
    <div class="col-auto">
        <input type="text" class="form-control mb-2" name="username" value="<?= $search['username'] ?>" placeholder="用户名">
    </div>
    <div class="col-auto">
        <input type="text" class="form-control mb-2" name="truename" value="<?= $search['truename'] ?>" placeholder="姓名">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-2">搜索</button>
    </div>
    <div class="col-auto">
        <a id="create-user-btn" class="btn btn-primary mb-2">创建</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>用户名</th>
                <th>姓名</th>
                <th>手机号</th>
                <th>邮箱</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($models)): ?>
                <?php foreach ($models as $model): ?>
                    <tr>
                        <td><a href="<?php echo \yii\helpers\Url::toRoute(['/user/detail', 'uid' => $model['id']]); ?>"><?= $model['username'] ?></a></td>
                        <td><?= $model['truename'] ?></td>
                        <td><?= $model['mobile'] ?></td>
                        <td><?= $model['email'] ?></td>
                        <td>
                            <a href="javascript:void(0)" class="btn-sm btn-success update-user-btn" prikey-val="<?= $model['id'] ?>">编辑</a>
                            <a href="javascript:void(0)" class="btn-sm btn-danger delete-user-btn" prikey-val="<?= $model['id'] ?>" str="<?= $model['username'] ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="text-right">
    <?= \common\widgets\DhLinkPager::widget([
        'pagination' => $pages,
    ]); ?>
</div>

<script>
    $(document).ready(function () {
        createModalBind("user");
        updateModalBind("user");
        saveModalBind("user");
        deleteModalBind("user");
    });
</script>

