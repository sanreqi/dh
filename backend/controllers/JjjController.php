<?php


namespace backend\controllers;


use common\models\JjjBan;
use common\services\JjjService;
use yii\di\ServiceLocator;
use yii\web\Controller;
use Yii;

class JjjController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex() {
//        $currentTime = time();
//        $keywords = ['从来','一直','肯定','狠','无敌','绝了','不要脸','不理人',
//                '不是人','故意','长期这样','一年前','半年前','恶毒','不善良','折磨','恶心','舒服','开心'];
//        foreach ($keywords as $v) {
//            $model = new JjjBan();
//            $model->keyword = $v;
//            $model->degree = 0;
//            $model->is_delete = 0;
//            $model->create_time = $currentTime;
//            $model->update_time = $currentTime;
//            $model->save();
//        }

        return $this->render('index');
    }

    public function actionCreateUpdateBan() {
        $params =  Yii::$app->request->post();
        $service = new JjjService();
        $result = $service->createUpdateBan($params);
        if (false === $result) {
            echo json_encode(['status'=>0,'errMsg'=>$service->getErrMsg()]);
            exit;
        } else {
            echo json_encode(['status'=>1]);
            exit;
        }
    }

    public function actionBanList() {
        $params =  Yii::$app->request->get();
        $service = new JjjService();
        $data = $service->banList($params);
        echo json_encode(['status'=>1,'data'=>$data]);
        exit;
    }

    public function actionDeleteBan() {
        $id = Yii::$app->request->post('id', 0);
        $service = new JjjService();
        $result = $service->deleteBan($id);
        if (false === $result) {
            echo json_encode(['status'=>0,'errMsg'=>$service->getErrMsg()]);
            exit;
        } else {
            echo json_encode(['status'=>1]);
            exit;
        }
    }
}
