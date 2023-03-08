<?php

namespace backend\controllers;
use Yii;

class TestController extends BaseController
{
    public function actionIndex() {
        print_r(Yii::$app->controller->module->id);exit;
//        echo Yii::$app->module->id;exit;
//        echo Yii::$app->controller->id;exit;
//        $path = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
        echo 11; exit;
    }
}