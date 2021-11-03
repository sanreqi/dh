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
        $auth = Yii::$app->authManager;
        $data = require __DIR__ . '/../components/rbac/PermissionData.php';
        foreach ($data as $project => $items) {
            foreach ($items as $item) {
                $name = UserProject::getProjectByKey($project) . $item['name'];
                $ex = $auth->getPermission($name);
                if ($ex) {
                    continue;
                }

                $permission = $auth->createPermission($name);
                $permission->description = $item['description'];
                $auth->add($permission);
            }
        }
    }
}