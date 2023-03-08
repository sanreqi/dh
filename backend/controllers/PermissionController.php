<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;

class PermissionController extends BaseController
{
    public function actionIndex() {
        $auth = Yii::$app->authManager;
        $roleName = Yii::$app->request->get('role');
        $role = $auth->getRole($roleName);
        if (empty($role)) {
            throw new NotFoundHttpException();
        }
        $children = $auth->getChildren($roleName);
//        print_r($children);exit;
        $ownPermissions = array_keys($children);

        $permissions = Yii::$app->params['permissions'];
        return $this->render('index', ['permissions' => $permissions,
            'role' => $role, 'ownPermissions' => $ownPermissions]);
    }

    public function actionSave() {
        $auth = Yii::$app->authManager;
        $post = Yii::$app->request->post();
        if (!isset($post['role']) || empty($post['role'])) {
            $this->errorAjax('参数错误');
        }
        $role = $auth->getRole($post['role']);
        if (empty($role)) {
            $this->errorAjax('角色名称不存在');
        }
        //删除原有role下的permission,目前不支持role和role有上下级
        $auth->removeChildren($role);
        if (!isset($post['permissions']) || empty($post['permissions'])) {
            $this->successAjax();
        }
        $permissionNames = $post['permissions'];
        $permissionNames = array_unique($permissionNames);
        try {
            foreach ($permissionNames as $permissionName) {
                $permission = $auth->getPermission($permissionName);
                if (!empty($permission)) {
                    $auth->addChild($role, $permission);
                }
            }
        } catch (\Exception $e) {
            $this->errorAjax('未知错误');
        }
        $this->successAjax();
    }
}