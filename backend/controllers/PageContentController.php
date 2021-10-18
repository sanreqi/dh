<?php

namespace backend\controllers;
use Yii;
use backend\forms\ReportForm;
use backend\models\forms\UploadForm;
use yii\web\UploadedFile;

class PageContentController extends BaseController
{
    public function actionIndex() {
        if (Yii::$app->request->post()) {

        }

        $model = new UploadForm();
        return $this->render('index', ['model' => $model]);
    }

    public function actionUpload() {
        if (!Yii::$app->request->isPost) {
            $this->errorEchoAjax('非法请求');
        }
        $model = new UploadForm();
        $model->file = UploadedFile::getInstance($model, 'file');
        if ($model->file && $model->validate()) {
            if ($model->upload() === false) {
                $this->errorEchoAjax($model->getErrorMsg());
            } else {
                $this->successEchoAjax(['src' => $model->webPath]);
            }
        } else {
            $this->errorEchoAjax(getModelError($model));
        }
    }

    public function actionSaveContent() {
        $post = Yii::$app->request->post();
        print_r($post);exit;
    }
}