<?php
namespace backend\controllers;

use backend\components\MyBehavior;
use common\helper\Tools;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\forms\LoginForm;

/**
 * Site controller
 */
class SiteController extends BaseController
{

    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::class,
//                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
//                    [
//                        'actions' => ['logout', 'index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::class,
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => false
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->layout = false;
        }

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = false;
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLoginAjax() {
        if (!Yii::$app->request->isAjax || !Yii::$app->request->isPost) {
            $this->errorAjax('非法访问');
        }

        $post = Yii::$app->request->post();
        if (isset($post['LoginForm']['rememberMe']) && !empty($post['LoginForm']['rememberMe'])) {
            $post['LoginForm']['rememberMe'] = true;
        } else {
            $post['LoginForm']['rememberMe'] = false;
        }

        $model = new LoginForm();
        if ($model->load($post) && $model->login()) {
            $this->sendCookies();
            $returnData['data'] = [];
            $returnData['status'] = 1;
            header('Content-Type:application/json; charset=utf-8');
            echo json_encode($returnData,JSON_UNESCAPED_UNICODE);
            exit;
        } else {
            $this->errorAjax('用户名或密码不正确');
        }
    }

}
