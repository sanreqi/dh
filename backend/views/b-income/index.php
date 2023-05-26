<?php
/* @var $this \yii\web\View */
/* @var $params */
/* @var $pages */
/* @var $count */
\common\assets\DateTimePickerAsset::register($this);
$this->title = 'INCOME';

?>

<div class="modal fade" id="b-income-modal" tabindex="-1" aria-labelledby="b-income-modal-label" aria-hidden="true"></div>

<form class="form-row align-items-center">
    <div class="col-auto">
        <input class="form-control mb-2" name="date"
               value="<?php echo isset($params['date']) && !empty($params['date']) ? date('Y-m-d', strtotime($params['date'])) : ''; ?>" id="date" type="text">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-2">搜索</button>
    </div>
    <div class="col-auto">
        <a id="create-b-income-btn" class="btn btn-primary mb-2">创建</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>账户名</th>
            <th>收入金额</th>
            <th>收入时间</th>
            <th>备注</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $model): ?>
                <tr>
                    <td><?= $model['id'] ?></td>
                    <td><?= $model['username'] ?></td>
                    <td><?= $model['account_name'] ?></td>
                    <td><?= $model['amount'] ?></td>
                    <td><?= $model['date'] ?></td>
                    <td><?= $model['remark'] ?></td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-success update-b-income-btn" prikey-val="<?= $model['id'] ?>">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-b-income-btn" prikey-val="<?= $model['id'] ?>" str="<?= $model['id'] ?>">删除</a>
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

<script>
    $(document).ready(function () {
        // $('#date').datetimepicker({
        //     lang: 'ch',
        //     timepicker: false,
        //     format: 'Y-m-d',
        // });

        createModalBind("b-income");
        updateModalBind("b-income");
        saveModalBind("b-income");
        deleteModalBind("b-income");
    });


</script>

