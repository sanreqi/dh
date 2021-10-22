<?php

namespace backend\controllers;
use Yii;
use backend\models\forms\AdminUserForm;
use common\models\AdminUser;
use yii\data\Pagination;

class AdminUserController extends BaseController
{
    public function actionIndex() {
        $params = Yii::$app->request->get();
        $search['username'] = Yii::$app->request->get('username', '');
        $search['truename'] = Yii::$app->request->get('truename', '');
        $model = new AdminUser();
        $models = $model->search($params);
        $count = $model->search($params, true);
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
        return $this->render('index', ['models' => $models, 'search' => $search, 'pages' => $pages]);
    }

    public function actionCreateModal() {
        $html = $this->renderPartial('_user_modal', ['model' => []]);
        $this->successAjax(['html' => $html]);
    }

    public function actionUpdateModal() {
        $id = Yii::$app->request->get('id');
        if (empty($id)) {
            $this->errorAjax('缺少参数');
        }

        $model = AdminUser::find()->where(['id' => $id, 'status' => AdminUser::STATUS_ACTIVE])->one();
        if (empty($model)) {
            $this->errorAjax('用户不存在');
        }

        $html = $this->renderPartial('_user_modal', ['model' => $model]);
        $this->successAjax(['html' => $html]);
    }

    public function actionSaveAdminUser() {
        $post = Yii::$app->request->post();
        $model = new AdminUserForm();
        $model->load($post);
        $model->scenario = !empty($model->id) ? 'update' : 'create';
        if (!$model->validate()) {
            $this->errorAjax(getModelError($model));
        }

        if ($model->saveAdminUser()) {
            $this->successAjax();
        } else {
            $this->errorAjax('保存失败');
        }
    }

    public function actionDeleteAdminUser() {
        $id = Yii::$app->request->post('id');
        if (empty($id)) {
            $this->errorAjax('非法请求');
        }

        $model = AdminUser::find()->where(['id' => $id, 'status' => AdminUser::STATUS_ACTIVE])->one();
        if (empty($model)) {
            $this->errorAjax('非法请求');
        }

        if ($model->username == 'admin') {
            $this->errorAjax('超级管理员不能删除');
        }

        $model->status = AdminUser::STATUS_DELETED;
        if ($model->save()) {
            $this->successAjax();
        } else {
            $this->errorAjax('删除失败');
        }
    }
}