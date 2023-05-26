<?php

namespace common\services;

use Yii;
use common\helper\Tools;
use common\models\BAccount;
use common\models\BIncome;
use common\models\User;

class BIncomeService
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
        $query = BIncome::find()->where(['is_delete' => 0]);
        if ($count) {
            return $query->count();
        }

        //分页
        Tools::constructPage($query, $params);
        $result = $query->asArray()->all();
        foreach ($result as &$v) {
            $v['username'] = UserService::getNameByUid($v['uid']);
            $v['account_name'] = BAccountService::getNameById($v['account_id']);
        }

        return $result;
    }

    public function createUpdate($post) {
        $currentTime = time();
        $post = Tools::trimAllData($post);
        if (false === $this->checkCreateUpdate($post)) {
            return false;
        }

        if (isset($post['id']) && !empty($post['id'])) {
            //编辑
            $model = BIncome::find()->where(['is_delete'=>0, 'id'=>$post['id']])->limit(1)->one();
            if (empty($model)) {
                $this->errMsg = '收入id不正确';
                return false;
            }
        } else {
            $model = new BIncome();
            $model->uid = Yii::$app->user->identity->id;
        }

        $bAccount = BAccount::find()->where(['is_delete' => 0, 'id' => $post['account_id']])->limit(1)->one();
        $model->account_id = $post['account_id'];
        $model->date = $post['date'];
        $model->amount = $post['amount'];
        $model->remark = $post['remark'];
        $model->is_delete = 0;
        $model->create_time = $currentTime;
        $model->update_time = $currentTime;
        $bAccount->amount = $post['balance'];
        $bAccount->update_time = $currentTime;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $flag1 = $model->save();
            $flag2 = $bAccount->save();
            if ($flag1 && $flag2) {
                $transaction->commit();
                return true;
            } else {
                $transaction->rollBack();
                $this->errMsg = '保存失败';
                return false;
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->errMsg = '保存失败';
            return false;
        }
    }

    public function checkCreateUpdate($post) {
        $requireFields = ['account_id' => '账户', 'date' => '收入时间', 'amount' => '收入金额', 'balance' => '账户余额'];
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

        if (!is_numeric($post['balance'])) {
            $this->errMsg = '余额必须为数字';
            return false;
        }

        $bAccount = BAccount::find()->where(['is_delete' => 0, 'id' => $post['account_id']])->count();
        if (empty($bAccount)) {
            $this->errMsg = '账户不正确';
            return false;
        }
    }
}