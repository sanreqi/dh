<?php

namespace backend\controllers;

use api\common\helpers\Tools;
use api\modules\app\models\Address;
use api\modules\app\models\excel\CheckOut;
use common\models\UploadExcelFile;
use Yii;

class RoleController extends BaseController
{
    public function actionIndex123() {
        $auth = Yii::$app->authManager;
//        $r1 = $auth->createRole('r1');
//        $auth->add($r1);
//        $r2 = $auth->createRole('r2');
//        $auth->add($r2);
//        $r = $auth->createRole('r');
//        $auth->add($r);
//        $p1 = $auth->createPermission('p1');
//        $auth->add($p1);
//        $p2 = $auth->createPermission('p2');
//        $auth->add($p2);
//
//        $auth->addChild($r, $r1);
//        $auth->addChild($r1, $r2);
//        $auth->addChild($r, $p1);

//        $p1 = $auth->getPermission('p1');
//        $p2 = $auth->getPermission('p2');
//        $auth->addChild($p1, $p2);


        $t = $auth->revokeAll(1);
        print_r($t);exit;
        $p1 = $auth->getPermission('p1');
        $auth->update('p2', $p1);
        $ps = $auth->getChildren('r');

        print_r($ps);exit;

        $r = $auth->getRole('r');
        $p1 = $auth->getPermission('p1');
//        $auth->assign($r,1);
        if ($auth->checkAccess(1, 'p2')) {
            echo 123; exit;
        } else {
            echo 456; exit;
        }

        $a = $auth->getChildren('r');
        print_r($a);exit;

//        $auth->
        $models = $auth->getRoles();
        $c=$auth->getChildren('销售');
//        print_r($c);exit;
        return $this->render('index', ['models' => $models]);
    }

    public function actionIndex() {
        if (1) {
            $list = [];
            foreach ([1,2] as $v) {
                $row = [];
                $row['address'] = 1;
                $row['street'] = 2;
                $row['grid'] = 3;
                $row['community'] = 4;
                $row['create_time'] = 5;
                $list[] = $row;
            }
        }
        $title = [
            'address' => '地址',
            'street' => '所属街道',
            'grid' => '网格',
            'community' => '居委',
            'create_time' => '创建时间',
        ];

        $filename = '地址库列表' . date('Ymd_His') . '.xlsx';

        exportExcel($filename, $title, $list);

//        $uploadModel = new UploadExcelFile();
//        $res = $uploadModel->upload();
//        if($res !== true){
//            throw new \Exception('文件上传失败');
//        }
//        $data = $uploadModel->readFile();
//     print_r($data);exit;

    }


}