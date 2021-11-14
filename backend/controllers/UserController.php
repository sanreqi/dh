<?php

namespace backend\controllers;
use common\helper\Tools;
use common\services\RbacService;
use Yii;
use backend\models\forms\UserForm;
use common\models\User;
use yii\data\Pagination;

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
        $html = $this->renderPartial('_user_modal', ['model' => []]);
        $this->successAjax(['html' => $html]);
    }

    public function actionUpdateModal() {
        $id = Yii::$app->request->get('id');
        if (empty($id)) {
            $this->errorAjax('缺少参数');
        }

        $model = User::find()->where(['id' => $id, 'status' => User::STATUS_ACTIVE])->one();
        if (empty($model)) {
            $this->errorAjax('用户不存在');
        }

        $html = $this->renderPartial('_user_modal', ['model' => $model]);
        $this->successAjax(['html' => $html]);
    }

    public function actionCreate() {
        $post = Yii::$app->request->post();
        $model = new UserForm();
        $model->scenario = 'create';
        $model->load($post);
        if (!$model->validate()) {
            $this->errorAjax(Tools::getModelError($model));
        }

        if ($model->saveUser()) {
            $this->successAjax();
        } else {
            $this->errorAjax('保存失败');
        }
    }

    public function actionUpdate() {
        $id = Yii::$app->request->get('id');
        if (empty($id)) {
            $this->errorAjax('缺少参数');
        }
        $post = Yii::$app->request->post();
        $model = new UserForm();
        $model->scenario = 'update';
        $model->load($post);
        $model->id = $id;
        if (!$model->validate()) {
            $this->errorAjax(Tools::getModelError($model));
        }

        if ($model->saveUser()) {
            $this->successAjax();
        } else {
            $this->errorAjax('保存失败');
        }
    }

    public function actionDelete() {
        $id = Yii::$app->request->post('id');
        if (empty($id)) {
            $this->errorAjax('非法请求');
        }

        $model = User::find()->where(['id' => $id, 'status' => User::STATUS_ACTIVE])->one();
        if (empty($model)) {
            $this->errorAjax('非法请求');
        }

        if ($model->username == 'admin') {
            $this->errorAjax('超级管理员不能删除');
        }

        $model->status = User::STATUS_DELETED;
        if ($model->save()) {
            $this->successAjax();
        } else {
            $this->errorAjax('删除失败');
        }
    }

    /**
     * 用户详情
     */
    public function actionDetail() {
        $uid = Yii::$app->request->get('uid');
        $user = User::find()->where(['id' => $uid])->one();
        if (empty($user)) {
            //@todo srq 404
        }
        return $this->render('detail', ['uid' => $uid]);
    }

    //@todo srq 选中
    public function actionGetRoleFormHtml() {
        $uid = Yii::$app->request->get('uid');
        if (empty($uid)) {
            $this->errorAjax('非法请求');
        }
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $html = $this->renderPartial('_role_form', ['roles' => $roles, 'uid' => $uid]);
        $this->successAjax(['html' => $html]);
    }

    //文字
    public function actionGetRoleViewHtml() {
        $uid = Yii::$app->request->get('uid');
        if (empty($uid)) {
            $this->errorAjax('非法请求');
        }
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $html = $this->renderPartial('_role', ['roles' => $roles, 'uid' => $uid]);
        $this->successAjax(['html' => $html]);
    }

    public function actionAssignRole() {
        $post = Yii::$app->request->post();
        if (!isset($post['uid']) || empty($post['uid'])) {
            $this->errorAjax('非法请求');
        }
        $uid = $post['uid'];
        $roleNames = isset($post['roles']) ? $post['roles'] : [];
        $service = new RbacService();
        $service->assignRoles($uid, $roleNames);
    }
}