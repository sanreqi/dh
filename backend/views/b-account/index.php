<?php
/* @var $this \yii\web\View */
/* @var $params */
/* @var $pages */
/* @var $count */
$this->title = 'ACCOUNTING';
\common\assets\DateTimePickerAsset::register($this);
?>


<div class="modal fade" id="b-account-modal" tabindex="-1" aria-labelledby="b-account-modal-label" aria-hidden="true"></div>
<div class="modal fade" id="record-modal" tabindex="-1" aria-labelledby="record-modal-label" aria-hidden="true"></div>

<form class="form-row align-items-center">
    <div class="col-auto">
        <input class="form-control mb-2" name="date" placeholder="无效搜索"
               value="<?php echo isset($params['date']) && !empty($params['date']) ? date('Y-m-d', strtotime($params['date'])) : ''; ?>" id="date" type="text">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-2">搜索</button>
    </div>
    <div class="col-auto">
        <a id="create-b-account-btn" class="btn btn-primary mb-2">创建</a>
    </div>
    <div class="col-auto">
        <a id="create-record-btn" class="btn btn-primary mb-2">结算</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>ID</th>
            <th>账户名称</th>
            <th>账户号</th>
            <th>余额</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $model): ?>
                <tr>
                    <td><?= $model['id'] ?></td>
                    <td><?= $model['name'] ?></td>
                    <td><?= $model['account'] ?></td>
                    <td><?= $model['amount'] ?></td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-b-account-btn" prikey-val="<?= $model['id'] ?>">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-b-account-btn" prikey-val="<?= $model['id'] ?>" str="<?= $model['name'] ?>">删除</a>
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

    共<?php echo $count; ?>条
</div>

<?php $recordModalHtml = $this->context->renderPartial('_record_modal'); ?>
<input type="hidden" value='<?php echo $recordModalHtml; ?>' name="record-modal-html" id="record-modal-html">

<script>
    $(document).ready(function () {
        createModalBind("b-account");
        updateModalBind("b-account");
        saveModalBind("b-account");
        deleteModalBind("b-account");
    });
    $("#create-record-btn").click(function () {
        let html = $("#record-modal-html").val();
        $("#record-modal").html(html).modal();
    });
</script>
