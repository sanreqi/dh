<?php
namespace common\services;

use Yii;
use yii\web\IdentityInterface;

class RbacService {
    /**
     * 分配角色
     * @param $uid
     * @param $roleNames
     * @throws \Exception
     */
    public function assignRoles($uid, $roleNames) {
        $auth = Yii::$app->authManager;
        $allRoles = $auth->getRoles();
        $assignments = $auth->getAssignments($uid);
        //已分配角色
        $assignRoleNames = [];
        if (!empty($assignments)) {
            foreach ($assignments as $assignment) {
                $assignRoleNames[] = $assignment->roleName;
            }
        }
        //全量处理
        if (!empty($allRoles)) {
            foreach ($allRoles as $role) {
                $roleName = $role->name;
                if (in_array($roleName, $assignRoleNames) && !in_array($roleName, $roleNames)) {
                    //已经分配权限取消勾选
                    $auth->revoke($role, $uid);
                }
                if (!in_array($roleName, $assignRoleNames) && in_array($roleName, $roleNames)) {
                    //未分配角色勾选
                    $auth->assign($role, $uid);
                }
            }
        }
    }

    /**
     * 是否为超级管理员
     */
    public static function isAdmin(IdentityInterface $identity = null) {
        if ($identity === null) {
            $identity = Yii::$app->user->identity;
        }
        if (empty($identity)) {
            return false;
        }
        $auth = Yii::$app->authManager;
        $assignment = $auth->getAssignment('admin', $identity->getId());
        //权限验证,admin无视一切
        if ($identity->username == 'admin' || !empty($assignment)) {
            return true;
        }
        return false;
    }

    /**
     * 验证用户是否有权限访问
     * @param Yii\web\User $user
     * @param $path
     * @return bool
     */
    public static function checkPermission(IdentityInterface $identity, $path) {
        if (empty($identity)) {
            return false;
        }

        if (self::isAdmin($identity)) {
            //权限验证,admin无视一切
            return true;
        }

        $auth = Yii::$app->authManager;
        $path = Yii::$app->params['project'] . '/' . $path;
        if ($auth->checkAccess($identity->getId(), $path)) {
            return true;
        }

        return false;
    }

    public static function getMenuItemHideCss($path) {
        if (Yii::$app->user->isGuest) {
            return '';
        }
        if (self::isAdmin()) {
            return '';
        }
        $identity = Yii::$app->user->identity;
        if (self::checkPermission($identity, $path)) {
            return '';
        }

        return 'style="display:none"';
    }

    public static function getMenuItemCheckedCss($path) {
        //url地址
        $pathInfo = Yii::$app->request->pathInfo;
        if ($path == $pathInfo) {
            return 'style=background-color:#0f6ecd';
        }

        return '';
    }
}