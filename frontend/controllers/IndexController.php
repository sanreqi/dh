<?php

namespace frontend\controllers;

use common\assets\BootstrapV4Asset;
use yii\data\Pagination;
use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex() {

        $pages = new Pagination(['totalCount'=>100,'pageSize'=>5]);

        return $this->render('index', ['pages' => $pages]);

//        $this->layout = false;
//        return $this->render('index');
    }

}