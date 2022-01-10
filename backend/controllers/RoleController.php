<?php

namespace backend\controllers;

use common\models\AuthItem;
use backend\models\forms\RoleForm;
use common\helper\Tools;
use common\models\Constants;
use common\services\RbacService;
use Yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\rbac\Item;

class RoleController extends BaseController
{
    public function actionIndex() {
        $service = new RbacService();
        $service->getAllChildrenUid(2);

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
        $auth = Yii::$app->authManager;
        $parentRoles = array_keys($auth->getRoles());
        $html = $this->renderPartial('_role_modal', ['model' => [], 'parent_roles' => $parentRoles, 'parent' => '', 'title' => '创建角色']);
        $this->successAjax(['html' => $html]);
    }

    public function actionUpdateModal() {
        $name = Yii::$app->request->get('name');
        $auth = Yii::$app->authManager;
        $model = $auth->getRole($name);
        $parentRoles = array_diff(array_keys($auth->getRoles()), [$name]);
        $query = new Query();
        $authItemChild = $query->from('auth_item_child')->where(['child' => $name])->one();
        $parent = !empty($authItemChild) ? $authItemChild['parent'] : '';
        $html = $this->renderPartial('_role_modal', ['model' => $model, 'parent_roles' => $parentRoles, 'parent' => $parent, 'title' => '修改角色']);
        $this->successAjax(['html' => $html]);
    }

    public function actionCreate() {
        $post = Yii::$app->request->post();
        $model = new RoleForm();
        $model->load($post);
        try {
            if ($model->createRole()) {
                $this->successAjax();
            } else {
                $this->errorAjax($model->getErrorMsg());
            }
        } catch (\Exception $e) {
            $this->errorAjax($e->getMessage());
        }
    }

    public function actionUpdate() {
        $post = Yii::$app->request->post();
        $model = new RoleForm();
        $model->load($post);
        try {
            if ($model->updateRole()) {
                $this->successAjax();
            } else {
                $this->errorAjax($model->getErrorMsg());
            }
        } catch (\Exception $e) {
            $this->errorAjax($e->getMessage());
        }
    }

    public function actionDelete() {
        //@todo srq
    }

}