<?php

namespace backend\controllers;
use common\models\BAccount;
use common\models\BIncome;
use common\models\Constants;
use common\services\BAccountService;
use common\services\BIncomeService;
use common\services\UserService;
use Yii;
use yii\data\Pagination;

class BIncomeController extends BaseController
{
    public function actionIndex() {
        $params = Yii::$app->request->getQueryParams();
        $pageSize = isset($params['per-page']) && !empty($params['per-page']) ? $params['per-page'] : 10;
        $service = new BIncomeService();
        $result = $service->pageList($params);
        $data = $result['data'];
        $count = $result['count'];
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        return $this->render('index', ['models' => $data, 'count' => $count, 'pages' => $pages, 'params' => $params]);
    }

    public function actionCreateModal() {
        $html = $this->renderPartial('_b-income_modal', ['model' => []]);
        $this->successAjax(['html' => $html]);
    }

    public function actionUpdateModal() {
        $id = Yii::$app->request->get('id');
        if (empty($id)) {
            $this->errorAjax('缺少参数');
        }

        $model = BIncome::find()->where(['id' => $id, 'is_delete' => 0])->asArray()->one();
        if (empty($model)) {
            $this->errorAjax('参数错误');
        }

        $model['username'] = UserService::getNameByUid($model['uid']);
        $account = BAccount::find()->where(['is_delete'=>0, 'id'=>$model['account_id']])->one();
        $model['account_name'] = $account->name;
        $model['balance'] = $account->amount;

        $html = $this->renderPartial('_b-income_modal', ['model' => $model]);
        $this->successAjax(['html' => $html]);
    }

    public function actionCreate() {
        $post = Yii::$app->request->post();
        $service = new BIncomeService();
        if (false === $service->createUpdate($post)) {
            $this->errorAjax($service->getErrMsg());
        } else {
            $this->successAjax();
        }
    }

    public function actionUpdate() {
        $post = Yii::$app->request->post();
        $post['id'] = Yii::$app->request->get('id', '');
        $service = new BIncomeService();
        if (false === $service->createUpdate($post)) {
            $this->errorAjax($service->getErrMsg());
        } else {
            $this->successAjax();
        }
    }

    public function actionDelete() {
        $id = Yii::$app->request->post('id');
        if (empty($id)) {
            $this->errorAjax('非法请求');
        }
        $model = BIncome::find()->where(['id' => $id, 'is_delete' => Constants::IS_DELETE_NO])->one();
        if (empty($model)) {
            $this->errorAjax('非法请求');
        }
        $model->is_delete = 1;
        if ($model->save()) {
            $this->successAjax();
        } else {
            $this->errorAjax('删除失败');
        }
    }
}