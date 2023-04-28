<?php


namespace common\services;

use Yii;
use common\models\BAccount;
use common\helper\Tools;

class BAccountService
{
    private $errMsg;

    public function getErrMsg() {
        return $this->errMsg;
    }

    //不能用list作为方法名
    public function pageList($params) {
        $result['count'] = $this->search($params, true);
        $result['data'] = $this->search($params);
        return $result;
    }

    public function search($params, $count = false) {
        $query = BAccount::find()->where(['is_delete' => 0]);
        if ($count) {
            return $query->count();
        }

        //分页
        Tools::constructPage($query, $params);
        return $query->asArray()->all();
    }

    //创建编辑用一个方法
    public function createUpdate($post) {
        $currentTime = time();
        $post = Tools::trimAllData($post);
        if (false === $this->checkCreateUpdate($post)) {
            return false;
        }

        if (isset($post['id']) && !empty($post['id'])) {
            //编辑
            $model = BAccount::find()->where(['id' => $post['id']])->limit(1)->one();
            if (empty($model)) {
                $this->errMsg = '账户id不正确';
                return false;
            }
        } else {
            //创建
            $model = new BAccount();
        }
        $model->name = $post['name'];
        $model->account = $post['account'];
        $model->amount = $post['amount'];
        $model->is_delete = 0;
        $model->create_time = $currentTime;
        $model->update_time = $currentTime;
        if ($model->save()) {
            return true;
        } else {
            $this->errMsg = Tools::getModelError($model);
            return false;
        }
    }

    private function checkCreateUpdate($post) {
        $requireFields = ['name' => '账户名称', 'account' => '账户号', 'amount' => '余额'];
        foreach ($requireFields as $k => $v) {
            if (!isset($post[$k]) || $post[$k] === '' || $post[$k] === NULL) {
                $this->errMsg = $v . '不能为空';
                return false;
            }
        }

        if (!is_numeric($post['amount'])) {
            $this->errMsg = '金额必须为数字';
            return false;
        }

        if (isset($post['id']) && !empty($post['id'])) {
            //编辑
            $bAccount = BAccount::find()
                ->where(['!=', 'id', $post['id']])
                ->andWhere(['name' => $post['name']])
                ->limit(1)
                ->one();
            if (!empty($bAccount)) {
                $this->errMsg = '账户名称已经存在';
                return false;
            }
        } else {
            //创建
            $bAccount = BAccount::find()->where(['name' => $post['name']])->limit(1)->one();
            if (!empty($bAccount)) {
                $this->errMsg = '账户名称已经存在';
                return false;
            }
        }

        return true;
    }

    public static function findAllAccounts() {
        $models = BAccount::find()->where(['is_delete'=>0])->asArray()->all();
        return $models;
    }

}