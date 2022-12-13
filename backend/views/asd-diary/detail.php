<?php

/* @var  $model */
/* @var  $title */

$this->title = $title;
?>

<form id="asd-diary-form">
    <?php echo $model['content']; ?>
    <br/>
    <br/>
    <br/>
    <br/>
    <hr/>
    <div class="form-group row">
        <div class="col-sm-1">日期</div>
        <div class="col-sm-11"><?php echo $model['date']; ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">标题</div>
        <div class="col-sm-11"><?php echo $model['title']; ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">亮点</div>
        <div class="col-sm-11"><?php echo $model['bright']; ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">问题</div>
        <div class="col-sm-11"><?php echo $model['problem']; ?></div>
    </div>
</form>
