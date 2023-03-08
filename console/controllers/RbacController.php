<?php
namespace console\controllers;

use common\models\UserProject;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * 同步permission
     */
    public function actionTest() {
        return;
        $data = Yii::$app->params['permissions'];
        $auth = Yii::$app->authManager;
        foreach ($data as $k1 => $v1) {
            foreach ($v1 as $v2) {
                foreach ($v2 as $v3) {
                    $name = $k1 . $v3['name'];
                    $ex = $auth->getPermission($name);
                    if ($ex) {
                        continue;
                    }

                    $permission = $auth->createPermission($name);
                    $permission->description = $v3['description'];
                    $auth->add($permission);
                }
            }
        }
    }

    public function actionInitPermission() {
        $auth = Yii::$app->authManager;
        $permissions = Yii::$app->params['permissions'];
        foreach ($permissions as $v1) {
            foreach ($v1['data']  as $v2) {
                $authItem = $auth->getPermission($v2['name']);
                if ($authItem) {
                    $authItem->description = $v2['description'];
                    $auth->update($v2['name'], $authItem);
                } else {
                    $permission = $auth->createPermission($v2['name']);
                    $permission->description = $v2['description'];
                    $auth->add($permission);
                }
            }
        }

        echo '权限初始化成功';
        exit;
    }
}