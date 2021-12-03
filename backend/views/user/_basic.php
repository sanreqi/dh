<?php
/* @var $user; */
/* @var $userInfo; */
?>
<div class="card pr">
    <div class="card-body">
        <h5 class="card-title">基本信息</h5>
        <form id="basic-form">
            <div class="form-group row">
                <div class="col-sm-6"><span class="mr-20"><b>用户名</b></span><span><?= $user->username; ?></span></div>
                <div class="col-sm-6"><span class="mr-20"><b>姓名</b></span><span><?= $userInfo->name; ?>></span></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6"><span class="mr-20"><b>性别</b></span><span><?= $user->username; ?></span></div>
                <div class="col-sm-6"><span class="mr-20"><b>年龄</b></span><span>12</span></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6"><span class="mr-20"><b>手机</b></span><span><?= $user->username; ?></span></div>
                <div class="col-sm-6"><span class="mr-20"><b>身份证</b></span><span>12</span></div>
            </div>
        </form>
    </div>
    <button type="button" class="card-edit-btn">编辑</button>
</div>