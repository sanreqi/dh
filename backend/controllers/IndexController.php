<?php

namespace backend\controllers;


use backend\components\Foo;
use backend\components\MyBehavior;
use common\models\User;
use common\models\Page;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class IndexController extends Controller
{

    public function actionTest1() {
        $auth = \Yii::$app->authManager;
        $author = $auth->createRole('author');
        $auth->add($author);

//        $auth = \Yii::$app->authManager;
//        $createPost = $auth->createPermission('createPost');
//        $createPost->description = 'Create a post';
//        $result = $auth->add($createPost);
//        print_r($result);exit;
    }
	
    public function actionGo() {
	echo '[{"id":1,"image":"http://ww1.sinaimg.cn/mw690/006ThXL5ly1fj7zx3w751j30u00dmgy3.jpg","link":""},{"id":2,"image":"http://ww1.sinaimg.cn/mw690/006ThXL5ly1fj6ckx9tlwj30u00fqk8n.jpg","link":"/pages/list/list?cat=10"}]';
	exit;
    }

   // public function behaviors()
    //{
        //return [
            //MyBehavior::class,
        //];
   // }

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
