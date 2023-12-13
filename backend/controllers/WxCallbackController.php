<?php


namespace backend\controllers;

use common\services\WxCallbackService;
use yii\web\Controller;

class WxCallbackController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex() {
        $service = new WxCallbackService();
        echo $service->response();
        exit;
    }
}