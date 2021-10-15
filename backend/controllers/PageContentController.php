<?php

namespace backend\controllers;
use Yii;

class PageContentController extends BaseController
{
    public function actionIndex() {
        $this->successAjax();

        echo 123; exit;
        if (Yii::$app->request->post()) {

        }
        return $this->render('index');
    }
}