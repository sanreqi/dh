<?php

namespace backend\controllers;
use backend\models\forms\UserForm;
use common\models\User;
use Yii;
use yii\data\Pagination;
use yii\widgets\LinkPager;

class UserController extends BaseController
{
    public function actionIndex() {
        $params = Yii::$app->request->get();
        $search['username'] = Yii::$app->request->get('username', '');
        $search['truename'] = Yii::$app->request->get('truename', '');
        $model = new User();
        $models = $model->search($params);
        $count = $model->search($params, true);
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
        return $this->render('index', ['models' => $models, 'search' => $search, 'pages' => $pages]);
    }

    public function actionCreateModal() {
        $html = $this->renderPartial('_user_modal');
        $this->successAjax(['html' => $html]);
    }

    public function actionCreate() {
        $post = Yii::$app->request->post();
        if (empty($post)) {
            $this->errorAjax('缺少参数');
        }

        $model = new UserForm();
        $model->scenario = 'create';
        $model->load($post);
        if (!$model->validate()) {
            $this->errorAjax($this->getModelError($model));
        }

        $model->createUser();
        $this->successAjax();
    }

    public function actionUpdate() {

    }


}