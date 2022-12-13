<?php
/* @var $user; */
/* @var $userInfo; */
\common\assets\DateTimePickerAsset::register($this);
?>
<div class="card pr">
    <div class="card-body">
        <h5 class="card-title">基本信息</h5>
        <form id="basic-form">
            <div class="form-group row">
                <label for="truename" class="col-sm-2 col-form-label"><b>姓名</b></label>
                <div class="col-sm-8"><input value="<?= $userInfo->truename; ?>" id="truename" type="text" class="form-control" name="truename"></div>
            </div>
            <div class="form-group row">
                <label for="identity_card" class="col-sm-2 col-form-label"><b>身份证</b></label>
                <div class="col-sm-8"><input value="<?= $userInfo->identity_card; ?>" id="identity_card" type="text" class="form-control" name="identity_card" placeholder="性别和出生日期优先会根据身份证获取"></div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label"><b>性别</b></label>
                <div class="col-sm-8">
                    <?php $genderList = \common\models\UserInfo::getGenderList(); ?>
                    <select id="gender" name="gender" class="form-control">
                        <?php foreach ($genderList as $k => $v): ?>
                            <?php $selected = $userInfo->gender==$k ? 'selected' : ''; ?>
                            <option <?= $selected ?> value="<?= $k ?>"><?= $v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="birth_date" class="col-sm-2 col-form-label"><b>出生日期</b></label>
                <div class="col-sm-8"><input value="<?= $userInfo->birth_date ?>" id="birth_date" type="text" class="form-control" name="birth_date"></div>
            </div>
        </form>
    </div>
    <button type="button" class="card-edit-btn" id="save-basic-btn">保存</button>
</div>

<script>
    $('#birth_date').datetimepicker({
        lang:'ch',
        timepicker:false,
        format:'Y-m-d',
    });
</script>