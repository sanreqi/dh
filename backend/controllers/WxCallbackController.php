<?php


namespace backend\controllers;

use common\models\Contact;
use common\services\WxCallbackService;
use yii\web\Controller;

class WxCallbackController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $model = new Contact();
        $model->contact = 'wx-callback';
        $model->save();

        $service = new WxCallbackService();
        $response = $service->response();
        $model = new Contact();
        $model->contact = '====callback_response===='.json_encode($response);
        $model->save();


        exit;
    }
}