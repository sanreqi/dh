<?php

namespace backend\controllers;

use common\helper\Tools;
use common\models\Constants;
use Yii;
use backend\models\forms\PageForm;
use backend\models\forms\UserForm;
use common\models\Page;
use common\models\User;
use yii\data\Pagination;
use yii\filters\AccessControl;

class PageController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['special-callback'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $params = Yii::$app->request->get();
        $search['name'] = Yii::$app->request->get('name', '');
        $model = new Page();
        $models = $model->search($params);
        $count = $model->search($params, true);
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
        return $this->render('index', ['models' => $models, 'search' => $search, 'pages' => $pages]);
    }

    public function actionCreateModal() {
        $html = $this->renderPartial('_page_modal', ['model' => [], 'title' => '创建页面']);
        $this->successAjax(['html' => $html]);
    }

    public function actionUpdateModal() {
        $id = Yii::$app->request->get('id');
        if (empty($id)) {
            $this->errorAjax('缺少参数');
        }

        $model = Page::find()->where(['id' => $id, 'is_delete' => Constants::IS_DELETE_NO])->one();
        if (empty($model)) {
            $this->errorAjax('页面id不存在');
        }

        $html = $this->renderPartial('_page_modal', ['model' => $model, 'title' => '编辑页面']);
        $this->successAjax(['html' => $html]);
    }

    public function actionSavePage() {
        $post = Yii::$app->request->post();
        $model = new PageForm();
        $model->load($post);
        if (!$model->validate()) {
            $this->errorAjax(Tools::getModelError($model));
        }

        if ($model->savePage()) {
            $this->successAjax();
        } else {
            $errorMsg = !empty($model->errorMsg) ? $model->errorMsg : '保存失败';
            $this->errorAjax($errorMsg);
        }
    }

    public function actionDeletePage() {
        $id = Yii::$app->request->post('id');
        if (empty($id)) {
            $this->errorAjax('非法请求');
        }

        $model = Page::find()->where(['id' => $id, 'is_delete' => Constants::IS_DELETE_NO])->one();
        if (empty($model)) {
            $this->errorAjax('非法请求');
        }

        $model->is_delete = Constants::IS_DELETE_YES;
        if ($model->save()) {
            $this->successAjax();
        } else {
            $this->errorAjax('删除失败');
        }
    }

}