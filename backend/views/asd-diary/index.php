<?php
/* @var $this \yii\web\View */
/* @var $params */
/* @var $pages */
/* @var $count */
\common\assets\DateTimePickerAsset::register($this);
$this->title = 'DIARY';

?>

<div class="modal fade" id="asd-diary-modal" tabindex="-1" aria-labelledby=asd-diary-modal-label" aria-hidden="true">

</div>

<form class="form-row align-items-center">
    <div class="col-auto">
        <input class="form-control mb-2" name="date"
               value="<?php echo isset($params['date']) && !empty($params['date']) ? date('Y-m-d', strtotime($params['date'])) : ''; ?>" id="date" type="text">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-2">搜索</button>
    </div>
    <div class="col-auto">
        <a href="/asd-diary/form" id="create-asd-diary-btn" class="btn btn-primary mb-2">创建</a>
    </div>
    <input type="hidden" id="level_sort" name="level_sort" value="<?php echo isset($params['level_sort']) ? $params['level_sort'] : ''; ?>">
</form>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>日期</th>
            <th>标题</th>
            <th>亮点</th>
            <th>问题</th>
            <th style="color: #007bff;" class="dh-cp asd-level">层级</th>
            <th>内容</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $v): ?>
            <?php $date = date('Y-m-d', strtotime($v['date'])); ?>
            <?php $title = \common\services\AsdDiaryservice::getTitle($v['date'], $v['title']); ?>
                <tr>
                    <td><?= $date ?></td>
                    <td><?= $title ?></td>
                    <td><?= $v['bright'] ?></td>
                    <td><?= $v['problem'] ?></td>
                    <td><?= $v['level'] ?></td>
                    <td>详情中查看</td>
                    <td>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['asd-diary/form', 'id' => $v['id']]) ?>" class="btn-sm btn-success" prikey-val="<?= $v['id'] ?>">编辑</a>
                        <a href="javascript:void(0)" class="btn-sm btn-danger delete-asd-diary-btn" prikey-val="<?= $v['id'] ?>" str="<?= $date ?>">删除</a>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['asd-diary/detail', 'id' => $v['id']]) ?>" class="btn-sm btn-warning"><span style="color: white">详情</span></a>
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
        deleteModalBind("asd-diary");

        $('#date').datetimepicker({
            lang: 'ch',
            timepicker: false,
            format: 'Y-m-d',
        });

        $(".asd-level").click(function () {
            let sl = $("#level_sort").val();
            if (sl == "" || sl == "asc") {
                $("#level_sort").val("desc");
            }
            if (sl == "desc") {
                $("#level_sort").val("asc");
            }
            $("form").submit();
        });
    });
</script>

