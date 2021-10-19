<?php

namespace backend\controllers;
use common\models\PageContent;
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
        if (!isset($post['content']) || empty($post['content']) ||
            !isset($post['inputType']) || empty($post['inputType'])) {
            $this->errorEchoAjax('内容不能为空');
        }
        $contents = $post['content'];
        $inputTypes = $post['inputType'];
        if (count($contents) != count($inputTypes)) {
            $this->errorEchoAjax('非法请求');
        }
        for ($i=0; $i<count($contents); $i++) {
            $model = new PageContent();
            $model->page_id = 1;
            $model->type = $inputTypes[$i];
            $model->value = $contents[$i];
            $model->save();
        }
    }
}