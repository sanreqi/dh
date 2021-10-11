<?php

namespace frontend\controllers;

use common\assets\BootstrapV4Asset;
use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex() {

        $this->layout = false;
        return $this->render('index');
    }

}