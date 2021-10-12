<?php

namespace backend\controllers;
use common\models\User;
use Yii;

class UserController extends BaseController
{
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCreateModal() {
        $html = $this->renderPartial('_user_modal');
        $this->successAjax(['html' => $html]);
    }

    public function actionCreate() {
        $post = Yii::$app->request->post('Us2er');
        if (empty($post)) {
            $this->errorAjax('缺少参数');
        }


print_r($post);exit;
        $model = new User();
        $model->load($post);
        print_r($model->username);exit;
    }

    public function actionUpdate() {

    }


}