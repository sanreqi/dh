<?php

namespace backend\controllers;

use common\models\AuthItem;
use backend\models\forms\RoleForm;
use common\helper\Tools;
use common\models\Constants;
use Yii;
use yii\data\Pagination;
use yii\rbac\Item;

class RoleController extends BaseController
{
    public function actionIndex() {
        $params = Yii::$app->request->get();
        $params['type'] = Item::TYPE_ROLE;
        $search['name'] = Yii::$app->request->get('name', '');
        $model = new AuthItem();
        $count = $model->search($params, true);
        $models = $model->search($params);
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => Constants::PAGE_SIZE]);
        return $this->render('index', ['models' => $models, 'search' => $search, 'pages' => $pages]);
    }

    public function actionCreateModal() {
        $html = $this->renderPartial('_role_modal', ['model' => [], 'title' => '创建角色']);
        $this->successAjax(['html' => $html]);
    }

    public function actionUpdateModal() {
        $name = Yii::$app->request->get('name');
        $auth = Yii::$app->authManager;
        $model = $auth->getRole($name);
        $html = $this->renderPartial('_role_modal', ['model' => $model, 'title' => '修改角色']);
        $this->successAjax(['html' => $html]);
    }

    public function actionCreate() {
        $post = Yii::$app->request->post();
        $model = new RoleForm();
        $model->scenario = 'create';
        $model->load($post);
        if (!$model->validate()) {
            $this->errorAjax(Tools::getModelError($model));
        }
        try {
            if ($model->createRole()) {
                $this->successAjax();
            } else {
                $this->errorAjax('保存失败');
            }
        } catch (\Exception $e) {
            $this->errorAjax($e->getMessage());
        }
    }

    public function actionUpdate() {
        $post = Yii::$app->request->post();
        $model = new RoleForm();
        $model->scenario = 'update';
        $model->load($post);
        if (!$model->validate()) {
            $this->errorAjax(Tools::getModelError($model));
        }
        try {
            if ($model->updateRole()) {
                $this->successAjax();
            } else {
                $this->errorAjax('保存失败');
            }
        } catch (\Exception $e) {
            $this->errorAjax($e->getMessage());
        }
    }

    public function actionDelete() {
        //@todo srq
    }

}