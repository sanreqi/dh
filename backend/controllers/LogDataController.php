<?php

namespace backend\controllers;

use common\models\LogData;
use Yii;
use common\models\User;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class LogDataController extends Controller
{
    public function actionIndex() {
        $params = Yii::$app->request->get();
        $search['uid'] = Yii::$app->request->get('uid', '');
        $search['module'] = Yii::$app->request->get('module', '');
        $search['type'] = Yii::$app->request->get('type', '');
        $search['table'] = Yii::$app->request->get('table', '');
        $search['table_key'] = Yii::$app->request->get('table_key', '');
        $search['description'] = Yii::$app->request->get('description', '');
        $search['time_start'] = Yii::$app->request->get('time_start', '');
        $search['time_end'] = Yii::$app->request->get('time_end', '');

//        $search['username'] = Yii::$app->request->get('username', '');
//        $search['truename'] = Yii::$app->request->get('truename', '');
        $model = new LogData();
        $count = $model->search($params, true);
        $models = $model->search($params);
//print_r($models);exit;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
        return $this->render('index', ['models' => $models, 'search' => $search, 'pages' => $pages]);
    }

    public function actionDetail() {
        $id = Yii::$app->request->get('id', '');
        $model = LogData::find()->where(['id' => $id])->one();
        if (empty($model)) {
            throw new NotFoundHttpException();
        }
        return $this->render('detail', ['model' => $model]);
    }

}