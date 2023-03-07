<?php


namespace backend\controllers;

use common\models\Taxonomy;
use Yii;
use common\services\TaxonomyService;
use yii\web\Controller;

//class TaxonomyController extends BaseController

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

    public function actionDrag() {
        $params = Yii::$app->request->getBodyParams();
        $service = new TaxonomyService();
        $id = $service->drag($params);
        if (false === $id) {
            $this->errorAjax($service->getErrMsg());
        } else {
            $this->successAjax([]);
        }
    }

    public function actionInitTop() {
        $currentTime = time();
        $model = new Taxonomy();
        $model->id = 1;
        $model->parent_id = 0;
        $model->root_id = 1;
        $model->name = '分类';
        $model->sort = 1;
        $model->level = 0;
        $model->is_leaf = 1;
        $model->is_delete = 0;
        $model->create_time = $currentTime;
        $model->update_time = $currentTime;
        $model->save();
    }


}