<?php
/* @var $this \yii\web\View */
/* @var $search */
/* @var $pages */
use \common\models\WqBlacklist;
$this->title = '开狗黑名单';
?>

<div class="modal fade" id="wq-blacklist-modal" tabindex="-1" aria-labelledby="wq-blacklist-modal-label" aria-hidden="true">

</div>

<form class="form-row align-items-center">
    <div class="col-auto">
        <select type="text" class="form-control mb-2 w-200" name="platform" placeholder="平台">
            <?php foreach (WqBlacklist::getPlatformList() as $k => $v): ?>
                <option value="<?php echo $k; ?>" <?php echo $search['platform']==$k ? 'selected':'' ?>><?= $v; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-auto">
        <input type="text" class="form-control mb-2" name="username" value="<?= $search['username'] ?>" placeholder="用户名">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-2">搜索</button>
    </div>
    <div class="col-auto">
        <a id="create-wq-blacklist-btn" class="btn btn-primary mb-2">创建</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>平台</th>
            <th>账号</th>
            <th>备注</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $model): ?>
                <tr>
                    <td><?= WqBlacklist::getPlatformByKey($model['platform']) ?></td>
                    <td><?= $model['username'] ?></td>
                    <td><?= $model['description'] ?></td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-wq-blacklist-btn" prikey-val="<?= $model['id'] ?>">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-wq-blacklist-btn" prikey-val="<?= $model['id'] ?>" str="<?= $model['username'] ?>">删除</a>
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
        createModalBind("wq-blacklist");
        updateModalBind("wq-blacklist");
        saveModalBind("wq-blacklist");
        deleteModalBind("wq-blacklist");
    });
</script>

