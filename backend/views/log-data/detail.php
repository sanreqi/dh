<?php
use common\models\LogData;
/* @var $model */

$this->title = 'DETAIL';
?>

<div>
    <div class="form-group row">
        <div class="col-sm-1">ID</div>
        <div class="col-sm-11 detail-content"><?php echo $model['id']; ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">用户</div>
        <div class="col-sm-11 detail-content"><?php echo \common\models\User::findByIdAttr($model['uid'], 'username'); ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">模块</div>
        <div class="col-sm-11 detail-content"><?php echo $model['module']; ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">类型</div>
        <div class="col-sm-11 detail-content"><?php echo LogData::getTypeByKey($model['type']); ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">表</div>
        <div class="col-sm-11 detail-content"><?php echo $model['table']; ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">主键</div>
        <div class="col-sm-11 detail-content"><?php echo $model['table_key']; ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">描述</div>
        <div class="col-sm-11 detail-content"><?php echo $model['description']; ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">原数据</div>
        <div class="col-sm-11 detail-content"><?php echo $model['old_val']; ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">新数据</div>
        <div class="col-sm-11 detail-content"><?php echo $model['new_val']; ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">改变字段</div>
        <div class="col-sm-11 detail-content"><?php echo $model['change_attributes']; ?></div>
    </div>
    <div class="form-group row">
        <div class="col-sm-1">操作时间</div>
        <div class="col-sm-11 detail-content"><?php echo date('Y-m-d H:i:s', $model['time']); ?></div>
    </div>
</div>
