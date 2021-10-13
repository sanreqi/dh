<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);

//$this->registerJsFile('@web/static/js/dashbord.js', ['position' => \yii\web\View::POS_HEAD]);
//$this->registerCssFile('@web/static/css/bootstrap.min.css');
//$this->registerCssFile('@web/static/css/dashbord.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">-->
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse accordion">
            <div class="sidebar-sticky pt-3 accordion">
                <ul class="nav flex-column mb-2">
                    <li class="nav-item" id="headingOne">
                        <a class="nav-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                           aria-controls="collapseOne" href="#">
                            <span data-feather="file-text"></span>
                            侧边栏1
                        </a>
                    </li>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#sidebarMenu">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                侧边栏1-1
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                侧边栏1-2
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                侧边栏1-3
                            </a>
                        </li>
                    </div>
                </ul>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item" id="headingTwo">
                        <a class="nav-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                           aria-controls="collapseTwo" href="#">
                            <span data-feather="file-text"></span>
                            侧边栏2
                        </a>
                    </li>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#sidebarMenu">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                侧边栏2-1
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                侧边栏2-2
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                侧边栏2-3
                            </a>
                        </li>
                    </div>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?php echo $this->title; ?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                    </button>
                </div>
            </div>

            <?= $content ?>
<!--            <h2>Section title</h2>-->


            <?php echo \Yii::$app->view->render('_alert_confirm'); ?>
        </main>
    </div>
</div>




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

