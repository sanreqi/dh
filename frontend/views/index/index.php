<?php
//\common\assets\BootstrapV4Asset::register($this);
?>
123

<div class="text-right">
    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
//        'firstPageLabel' => "首页",
        'prevPageLabel' => '上一页',
        'nextPageLabel' => '下一页',
//        'lastPageLabel' => '末页',
//        'linkContainerOptions' => ['class' => 'page-item'],
//        'linkOptions' => ['class' => 'page-link'],
//        'firstPageCssClass' => '',
//        'lastPageCssClass' => '',
    ]); ?>
</div>