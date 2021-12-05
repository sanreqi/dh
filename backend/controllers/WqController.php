<?php


namespace backend\controllers;
use backend\components\QiArrLogic;
use Yii;

class WqController extends BaseController
{
    public function actionRank() {
        $number = Yii::$app->request->get('number', '');
        $qi = new QiArrLogic();
        if (!empty($number)) {
            if ($number<2 || $number>6) {
                //@todo srq
                echo '数字2-6之间';
                exit;
            }
            $qi->num = $number;
        }
        return $this->render('rank', ['number' => $number, 'qi' => $qi]);
    }
}