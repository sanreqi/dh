<?php


namespace backend\controllers;

use backend\models\forms\UserForm;
use common\helper\Tools;
use common\models\Constants;
use common\models\User;
use common\models\WqBlacklist;
use PHPUnit\Util\Blacklist;
use Yii;
use yii\data\Pagination;


class WqBlacklistController extends BaseController
{
    public function actionIndex() {
        $params = Yii::$app->request->get();
        $search['platform'] = Yii::$app->request->get('platform', WqBlacklist::PLATFORM_YEHU);
        $search['username'] = Yii::$app->request->get('username', '');
        $search['type'] = Yii::$app->request->get('type', 0);
        $model = new WqBlacklist();
        $models = $model->search($params);
        $count = $model->search($params, true);
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 20]);
        return $this->render('index', ['models' => $models, 'search' => $search, 'pages' => $pages, 'count' => $count]);
    }

    public function actionCreateModal() {
        $html = $this->renderPartial('_wq-blacklist_modal', ['model' => []]);
        $this->successAjax(['html' => $html]);
    }

    public function actionUpdateModal() {
        $id = Yii::$app->request->get('id');
        if (empty($id)) {
            $this->errorAjax('缺少参数');
        }

        $model = WqBlacklist::find()->where(['id' => $id, 'is_delete' => Constants::IS_DELETE_NO])->one();
        if (empty($model)) {
            $this->errorAjax('参数错误');
        }

        $html = $this->renderPartial('_wq-blacklist_modal', ['model' => $model]);
        $this->successAjax(['html' => $html]);
    }

    public function actionCreate() {
        $post = Yii::$app->request->post();
        //验证数据
        if (!isset($post['platform']) || empty($post['platform'])) {
            $this->errorAjax('平台不能为空');
        }
        if (!isset($post['username']) || empty(trim($post['username']))) {
            $this->errorAjax('用户名不能为空');
        }
        $post['username'] = trim($post['username']);
        $exists = WqBlacklist::find()->where(['is_delete' => Constants::IS_DELETE_NO])
            ->andWhere(['username' => $post['username']])->andWhere(['platform' => $post['platform']])->one();
        if (!empty($exists)) {
            $this->errorAjax('用户名已经存在');
        }

        $model = new WqBlacklist();
        if ($model->createWqBlacklist($post)) {
            $this->successAjax();
        } else {
            $this->errorAjax('保存失败');
        }
    }

    public function actionUpdate() {
        $post = Yii::$app->request->post();
        $id = Yii::$app->request->get('id', '');
        //验证数据
        if (empty($id)) {
            $this->errorAjax('id不能为空');
        }
        if (!isset($post['platform']) || empty($post['platform'])) {
            $this->errorAjax('平台不能为空');
        }
        if (!isset($post['username']) || empty(trim($post['username']))) {
            $this->errorAjax('用户名不能为空');
        }
        $post['id'] = $id;
        $post['username'] = trim($post['username']);
        $exists = WqBlacklist::find()->where(['is_delete' => Constants::IS_DELETE_NO])
            ->andWhere(['username' => $post['username']])->andWhere(['platform' => $post['platform']])
            ->andWhere(['!=', 'id', $id])->one();
        if (!empty($exists)) {
            $this->errorAjax('用户名已经存在');
        }

        $model = new WqBlacklist();
        if ($model->updateWqBlacklist($post)) {
            $this->successAjax();
        } else {
            $this->errorAjax('保存失败');
        }
    }

    public function actionDelete() {
        $id = Yii::$app->request->post('id');
        if (empty($id)) {
            $this->errorAjax('非法请求');
        }
        $model = WqBlacklist::find()->where(['id' => $id, 'is_delete' => Constants::IS_DELETE_NO])->one();
        if (empty($model)) {
            $this->errorAjax('非法请求');
        }
        $model->is_delete = Constants::IS_DELETE_YES;
        if ($model->save()) {
            $this->successAjax();
        } else {
            $this->errorAjax('删除失败');
        }
    }


}