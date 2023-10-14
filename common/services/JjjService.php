<?php


namespace common\services;


use common\models\JjjBan;

class JjjService
{
    private $errMsg;

    public function getErrMsg() {
        return $this->errMsg;
    }

    public function createUpdateBan($params) {
        if (false === $this->checkBan($params)) {
            return false;
        }

        $currentTime = time();
        $data = $params['ban'];
        if (isset($data['id']) && !empty($data['id'])) {
            $model = JjjBan::find()->where(['id'=>$data['id']])->one();
        } else {
            $model = new JjjBan();
            $model->create_time = $currentTime;
        }

        $model->keyword = trim($data['keyword']);
        $model->degree = $data['degree'];
        $model->is_delete = 0;
        $model->update_time = $currentTime;
        if (!$model->save()) {
            $this->errMsg = array_values($model->getFirstErrors())[0];
            return false;
        }

        return true;
    }

    private function checkBan($params) {
        if (!isset($params['ban']) || empty($params['ban'])) {
            $this->errMsg = '参数不正确';
            return false;
        }

        $data = $params['ban'];
        if (!isset($data['keyword']) || !isset($data['degree'])) {
            $this->errMsg = '参数不正确';
            return false;
        }

        $keyword = trim($data['keyword']);
        $degree = $data['degree'];

        if (empty($keyword)) {
            $this->errMsg = '关键字不能为空';
            return false;
        }
        if (!in_array($degree,array_keys(JjjBan::getDegreeList()))) {
            $this->errMsg = 'degree不正确';
            return false;
        }
        if (isset($data['id']) && !empty($data['id'])) {
            //编辑情况
            $model = JjjBan::find()->where(['id'=>$data['id']])->one();
            if(empty($model)) {
                $this->errMsg = 'id不正确';
                return false;
            }

            $model = JjjBan::find()
                ->andWhere(['!=','id',$data['id']])
                ->andWhere(['is_delete'=>0,'keyword'=>$keyword])
                ->one();
        } else {
            //创建情况
            $model = JjjBan::find()
                ->andWhere(['is_delete'=>0,'keyword'=>$keyword])
                ->one();
        }

        if (!empty($model)) {
            $this->errMsg = $keyword.'已经存在';
            return false;
        }

        return true;
    }

    public function banList($params) {
        $query = JjjBan::find()->where(['is_delete'=>0]);
        if (isset($params['degree']) && in_array($params['degree'],array_keys(JjjBan::getDegreeList()))) {
            $query->andWhere(['degree' => $params['degree']]);
        }
        if (isset($params['keyword']) && !empty(trim($params['keyword']))) {
            $query->andWhere(['like','keyword',$params['keyword']]);
        }
        //sortType 0-根据id排序，1-根据程度排序，2-根据出现频次排序
        $sortType = isset($params['sort_type']) ? $params['sort_type'] : 0;
        if ($sortType == 1) {
            $query->orderBy(['degree' => SORT_DESC]);
        } else {
            $query->orderBy(['id' => SORT_ASC]);
        }

        $result = $query->asArray()->all();
        return $result;
    }

    public function deleteBan($id) {
        $currentTime = time();
        $model = JjjBan::find()->where(['is_delete'=>0,'id'=>$id])->one();
        if (empty($model)) {
            $this->errMsg = '参数id不正确';
            return false;
        }

        $model->is_delete = 1;
        $model->update_time = $currentTime;
        if (!$model->save()) {
            $this->errMsg = array_values($model->getFirstErrors())[0];
            return false;
        }

        return true;
    }

}