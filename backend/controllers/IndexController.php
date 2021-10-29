<?php

namespace backend\controllers;


use backend\components\Foo;
use backend\components\MyBehavior;
use yii\web\Controller;

class IndexController extends BaseController
{

    public function behaviors()
    {
        return [
            MyBehavior::class,
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionTest() {
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



}