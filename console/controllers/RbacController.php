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
}