<?php


namespace backend\controllers;

use common\models\Taxonomy;
use Yii;
use backend\services\TaxonomyService;

class TaxonomyController extends BaseController
{
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * 获取树形数据
     */
    public function actionGetTreeData() {
        $service = new TaxonomyService();
        $params = Yii::$app->request->getQueryParams();
        $id = isset($params['id']) ? $params['id'] : 1;
        //多套一层
        $result[] = $service->tree($id);
        echo json_encode($result);
        exit;
    }

    public function actionCreate() {
        $params = Yii::$app->request->getBodyParams();
        $service = new TaxonomyService();
        $id = $service->create($params);
        if (false === $id) {
            $this->errorAjax($service->getErrMsg());
        } else {
            $this->successAjax(['id' => $id]);
        }
    }

    public function actionUpdate() {
        $params = Yii::$app->request->getBodyParams();
        $service = new TaxonomyService();
        $id = $service->update($params);
        if (false === $id) {
            $this->errorAjax($service->getErrMsg());
        } else {
            $this->successAjax(['id' => $id]);
        }
    }

    public function actionDelete() {
        $params = Yii::$app->request->getBodyParams();
        $service = new TaxonomyService();
        $id = $service->delete($params);
        if (false === $id) {
            $this->errorAjax($service->getErrMsg());
        } else {
            $this->successAjax(['id' => $id]);
        }
    }


}