<?php

namespace backend\controllers;
use common\models\User;
use Yii;
use yii\web\Controller;


class TestController extends Controller
{
    public function actionIndex() {
//        $user = User::find()->where(['username' => 'xinrujifeng'])->one();
//        $r = Yii::$app->user->login($user,1000);

//        print_r(Yii::$app->user->identity);exit;
    }

    public function actionIndex2() {

//        print_r(Yii::$app->user->identity);exit;

//print_r(Yii::$app->getResponse()->getCookies());exit;
//        print_r(Yii::$app->getResponse()->getCookies()->get('_identity-backend'));
//        exit;
//        Yii::$app->getResponse()->set
//        print_r(Yii::$app->getResponse()->getCookies());exit;
        $user = User::find()->where(['username' => 'xinrujifeng'])->one();
        $r = Yii::$app->user->login($user,1000);
        print_r($r);exit;
//        echo Yii::$app->user->identity->username;
        exit;
//echo 123; exit;
//        $user = User::find()->where(['username' => 'xinrujifeng'])->one();
//        $r = Yii::$app->user->login($user);

        echo Yii::$app->user->identity->username;
        exit;
//        print_r($r);exit;

//        return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);

    }
}