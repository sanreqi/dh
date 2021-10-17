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
            $this->errorAjax('非法请求');
        }
        $model = new UploadForm();
        $model->file = UploadedFile::getInstance($model, 'file');

        if ($model->file && $model->validate()) {
            $model->upload();
//            $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
        } else {
            print_r($model->getFirstErrors());exit;
        }




//        $post = Yii::$app->request->post();
//        //id为空时为添加，id不空为编辑，id和uid不能同时为空
//        $id = Yii::$app->request->get('id');
//        $uid = Yii::$app->request->get('uid');
//        if (empty($id) && empty($uid)) {
//            $this->errorAjax('非法请求');
//        }
//
//        //先赋值
//        $form->reportFile = UploadedFile::getInstance($form, 'reportFile');
//        $form->name = $post['name'];
    }
}