<?php

namespace backend\controllers;
use common\helper\Tools;
use common\models\Constants;
use common\models\Page;
use common\models\PageContent;
use Yii;
use backend\forms\ReportForm;
use backend\models\forms\UploadForm;
use yii\rest\DeleteAction;
use yii\web\UploadedFile;

class PageContentController extends BaseController
{
    public function actionIndex() {
        //@todo srq 404 and 编辑器延时加载内容

        $pageId = Yii::$app->request->get('page_id', '');
        $page = Page::find()->where(['is_delete' => Constants::IS_DELETE_NO, 'id' => $pageId])->one();
        if (empty($page)) {
            //404
        }
        $models = PageContent::find()->where(['is_delete' => Constants::IS_DELETE_NO, 'page_id' => $pageId])->all();
//        if (!empty($models)) {
//            return $this->render('update', ['models' => $models, 'page_id' => $pageId]);
//        }

        return $this->render('index', ['models' => $models, 'page_id' => $pageId]);
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
            $this->errorEchoAjax(Tools::getModelError($model));
        }
    }

    public function actionSave() {
        $post = Yii::$app->request->post();
        if (!isset($post['content']) || empty($post['content']) ||
            !isset($post['inputType']) || empty($post['inputType'])) {
            $this->errorAjax('内容不能为空');
        }
        $contents = $post['content'];
        $inputTypes = $post['inputType'];
        if (count($contents) != count($inputTypes)) {
            $this->errorAjax('非法请求');
        }
        if (!isset($post['page_id']) || empty($post['page_id'])) {
            $this->errorAjax('page_id不能为空');
        }
        $pageId = $post['page_id'];
        $page = Page::find()->where(['is_delete' => Constants::IS_DELETE_NO, 'id' => $post['page_id']])->one();
        if (empty($page)) {
            $this->errorAjax('page_id不存在');
        }

        //删除原有的
        PageContent::updateAll(['is_delete' => 1], ['page_id' => $pageId]);

        for ($i=0; $i<count($contents); $i++) {
            if (empty($contents[$i])) {
                continue;
            }
            $model = new PageContent();
            $model->page_id = $pageId;
            $model->type = $inputTypes[$i];
            $model->value = $contents[$i];
            $model->save();
        }

        $this->successAjax();
    }
}