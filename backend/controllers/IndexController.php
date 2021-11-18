<?php

namespace backend\controllers;


use backend\components\Foo;
use backend\components\MyBehavior;
use common\models\User;
use common\models\Page;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class IndexController extends BaseController
{

    public function behaviors()
    {
        return [
            MyBehavior::class,
        ];
    }

    public function actionIndex() {
        throw new NotFoundHttpException();
//        $this->prop3 = 1;
//        echo $this->prop1;
//        exit;
        $this->trigger('testE');
        return $this->render('index');
    }

    public function actionTest() {
        $page = Page::find()->where(['id' => 1])->one();
        print_r($page);exit;


        echo $this->foo();
        exit;
        $this->prop1 = 'hehe da';
        echo $this->prop1;
        exit;

        $foo = new Foo;

        // 处理器是全局函数
        $foo->on(Foo::EVENT_HELLO, [$foo, 'hello'], ['data' => 'heihei']);

        $foo->on(Foo::EVENT_HELLO, [$foo, 'bye'], ['data' => 'haha'], false);

        $foo->trigger(Foo::EVENT_HELLO);

        echo 'end'; exit;
    }


    public function teSe() {
        echo 777; exit;
    }


}