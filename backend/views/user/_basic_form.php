<?php
/* @var $user; */
/* @var $userInfo; */
?>
<div class="card pr">
    <div class="card-body">
        <h5 class="card-title">基本信息</h5>
        <form id="basic-form">
            <div class="form-group row">
                <label for="truename" class="col-sm-2 col-form-label"><b>姓名</b></label>
                <div class="col-sm-8"><input id="truename" type="text" class="form-control" name="truename"></div>
            </div>

            <div class="form-group row">
                <label for="identity_card" class="col-sm-2 col-form-label"><b>身份证</b></label>
                <div class="col-sm-8"><input id="identity_card" type="text" class="form-control" name="identity_card"></div>
            </div>
        </form>
    </div>
    <button type="button" class="card-edit-btn" id="save-basic-btn">保存</button>
</div>