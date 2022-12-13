<?php

/* @var $this yii\web\View */

$this->title = '首页';
?>
<div class="site-index">
    <div class="body-content">
        <div style="font-size: 40px;">吃饭吃三两</div>
    </div>
</div>

<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Collapsible Group Item #1
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Collapsible Group Item #2
                </button>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                Some placeholder content for the second accordion panel. This panel is hidden by default.
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingThree">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Collapsible Group Item #3
                </button>
            </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                And lastly, the placeholder content for the third and final accordion panel. This panel is hidden by default.
            </div>
        </div>
    </div>
</div>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse accordion">
    <div class="sidebar-sticky pt-3 accordion">
        <ul class="nav flex-column mb-2">
            <li class="nav-item" id="heading0">
                <a class="nav-link" data-toggle="collapse" data-target=".collapse0" aria-expanded="true" aria-controls="collapse0" href="/user/index">
                    <span class="glyphicon glyphicon-user"></span>
                    <span class="ml-8">用户</span>
                </a>
            </li>
            <div id="" class="collapse collapse0 " aria-labelledby="heading0" data-parent="#sidebarMenu">
                <li class="nav-item">
                    <a class="nav-link" href="/user/index">
                        <span class="ml-26">用户列表</span>
                    </a>
                </li>
            </div>
        </ul>
        <ul class="nav flex-column mb-2">
            <li class="nav-item" id="heading1">
                <a class="nav-link" data-toggle="collapse" data-target=".collapse1" aria-expanded="true" aria-controls="collapse1" href="/page/index">
                    <span class="glyphicon glyphicon-user"></span>
                    <span class="ml-8">页面</span>
                </a>
            </li>
            <div id="" class="collapse collapse1 " aria-labelledby="heading1" data-parent="#sidebarMenu">
                <li class="nav-item">
                    <a class="nav-link" href="/page/index">
                        <span class="ml-26">页面列表</span>
                    </a>
                </li>
            </div>
        </ul>
        <ul class="nav flex-column mb-2">
            <li class="nav-item" id="heading2">
                <a class="nav-link" data-toggle="collapse" data-target=".collapse2" aria-expanded="true" aria-controls="collapse2" href="/role/index">
                    <span class="glyphicon glyphicon-user"></span>
                    <span class="ml-8">安全</span>
                </a>
            </li>
            <div id="" class="collapse collapse2 show" aria-labelledby="heading2" data-parent="#sidebarMenu">
                <li class="nav-item">
                    <a style="background-color:#0f6ecd" class="nav-link" href="/role/index">
                        <span class="ml-26">角色列表</span>
                    </a>
                </li>
            </div>
            <div id="" class="collapse collapse2 show" aria-labelledby="heading2" data-parent="#sidebarMenu">
                <li class="nav-item">
                    <a class="nav-link" href="/permission/index">
                        <span class="ml-26">权限列表</span>
                    </a>
                </li>
            </div>
        </ul>

        <ul class="nav flex-column mb-2">
            <li class="nav-item" id="heading3">
                <a class="nav-link" data-toggle="collapse" data-target=".collapse3" aria-expanded="true" aria-controls="collapse3" href="/wq-blacklist/index">
                    <span class="glyphicon glyphicon-user"></span>
                    <span class="ml-8">围棋</span>
                </a>
            </li>
            <div id="" class="collapse collapse3" aria-labelledby="heading3" data-parent="#sidebarMenu">
                <li class="nav-item">
                    <a style="background-color:#0f6ecd" class="nav-link" href="/wq-blacklist/index">
                        <span class="ml-26">开狗黑名单</span>
                    </a>
                </li>
            </div>
            <div id="" class="collapse collapse3" aria-labelledby="heading3" data-parent="#sidebarMenu">
                <li class="nav-item">
                    <a class="nav-link" href="/wq/rank">
                        <span class="ml-26">围棋排列计算</span>
                    </a>
                </li>
            </div>
        </ul>
        <ul class="nav flex-column mb-2">
            <li class="nav-item" id="heading3">
                <a class="nav-link" data-toggle="collapse" data-target=".collapse3" aria-expanded="true" aria-controls="collapse3" href="/asd-diary/index">
                    <span class="glyphicon glyphicon-user"></span>
                    <span class="ml-8">ASD</span>
                </a>
            </li>
            <div id="" class="collapse collapse3" aria-labelledby="heading3" data-parent="#sidebarMenu">
                <li class="nav-item">
                    <a style="background-color:#0f6ecd" class="nav-link" href="/asd-diary/index">
                        <span class="ml-26">DIARY</span>
                    </a>
                </li>
            </div>
        </ul>
    </div>
</nav>