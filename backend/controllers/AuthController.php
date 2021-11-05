<?php

namespace backend\controllers;

use Yii;
use yii\db\Query;

class AuthController extends BaseController
{
    public function actionIndex() {
        $query = new Query();
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        return $this->render('index');
    }
}