<?php
/* @var $user; */
/* @var $userInfo; */
?>
<div class="card pr">
    <div class="card-body">
        <h5 class="card-title">基本信息</h5>
        <form id="basic-form">
            <div class="form-group row">
                <div class="col-sm-2"><b>用户名</b></div>
                <div class="col-sm-4"><?= $user->username; ?></div>
                <div class="col-sm-2"><b>姓名</b></div>
                <div class="col-sm-4"><?= $userInfo->truename; ?></div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2"><b>性别</b></div>
                <div class="col-sm-4">cccc</div>
                <div class="col-sm-2"><b>年龄</b></div>
                <div class="col-sm-4">eeee</div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2"><b>手机</b></div>
                <div class="col-sm-4">138888</div>
                <div class="col-sm-2"><b>身份证</b></div>
                <div class="col-sm-4">310111</div>
            </div>

        </form>
    </div>
    <button type="button" class="card-edit-btn" id="edit-basic-btn">编辑</button>
</div>