<?php
namespace common\services;

use Yii;

class RbacService {
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
}