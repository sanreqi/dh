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
        <input type="text"  class="form-control mb-2"  name="uid" value="<?= $search['uid'] ?>" placeholder="uid">
    </div>
    <div class="col-auto">
        <select type="text" class="form-control mb-2 w-200" name="module" placeholder="模块">
            <option>sss</option>
            <option>sss</option>
        </select>
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
            <th>用户</th>
            <th>模块</th>
            <th>类型</th>
            <th>表</th>
            <th>主键</th>
            <th>描述</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $model): ?>
                <tr>
                    <td><?= $model['username']; ?></td>
                    <td><?= $model['module']; ?></td>
                    <td><?= $model['type']; ?></td>
                    <td><?= $model['table']; ?></td>
                    <td><?= $model['table_key']; ?></td>
                    <td><?= $model['description']; ?></td>
                    <td><?= $model['time']; ?></td>
                    <td>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['log-data/detail', 'id' => $model['id']]) ?>" target="_blank" class="btn-sm btn-warning">详情</a>
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
