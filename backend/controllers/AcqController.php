<?php


namespace backend\controllers;


use yii\web\Controller;

class AcqController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionTest() {
        return $this->render('test');
    }

    public function actionForm() {
        $post = \Yii::$app->request->post();
        print_r($post);exit;
    }
}