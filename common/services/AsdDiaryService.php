<?php

namespace common\services;

use Yii;
use common\helper\Tools;
use common\models\AsdDiary;
use yii\db\Query;


class AsdDiaryService
{
    private $errMsg;

    public function getErrMsg() {
        return $this->errMsg;
    }

    public function createUpdate($params) {
        $currentTime = time();
        $model = $this->checkCreateUpdate($params);
        if (false === $model) {
            return false;
        }

        /* @var AsdDiary $model*/
        $model->date = $params['date'];
        $model->content = $params['content'];
        //level倒叙排
        if (isset($params['level']) && $params['level'] !== NULL && $params['level'] !== '') {
            $model->level = $params['level'];
        } else {
            //默认1
            $model->level = 1;
        }
        if (isset($params['bright'])) {
            $model->bright = $params['bright'];
        }
        if (isset($params['problem'])) {
            $model->problem = $params['problem'];
        }
        if (isset($params['title'])) {
            $model->title = $params['title'];
        }
        $model->is_delete = 0;
        $model->update_time = $currentTime;
        //@todo srq 有bug
        if (empty($model->isNewRecord)) {
            $model->create_time = $currentTime;
        }

        if (!$model->save()) {
            $this->errMsg = array_values($model->getFirstErrors())[0];
            return false;
        }

        return true;
    }

    private function checkCreateUpdate($params) {
        if (isset($params['id']) && !empty($params['id'])) {
            $model = AsdDiary::find()->where(['is_delete'=>0, 'id'=>$params['id']])->one();
            if (empty($model)) {
                $this->errMsg = '参数id不正确';
                return false;
            }
        } else {
            $model = new AsdDiary();
        }
        if (!isset($params['date']) || empty($params['date'])) {
            $this->errMsg = '日期不能为空';
            return false;
        }
        if (!isset($params['content']) || empty($params['content'])) {
            $this->errMsg = '内容不能为空';
            return false;
        }

        return $model;
    }

    //不能用list作为方法名
    public function pageList($params) {
        $result['count'] = $this->search($params, true);
        $result['data'] = $this->search($params);
        return $result;
    }

    public function search($params, $count = false) {
        $query = new Query();
        $query->from('asd_diary')->where(['is_delete' => 0]);
        if (isset($params['date']) && !empty($params['date'])) {
            $query->andWhere(['date' => $params['date']]);
        }
        if (isset($params['level_sort']) && !empty($params['level_sort'])) {
            if ($params['level_sort'] == 'desc') {
                $orderBy['level'] = SORT_DESC;
            }
            if ($params['level_sort'] == 'asc') {
                $orderBy['level'] = SORT_ASC;
            }
        }

        if ($count) {
            return $query->count();
        }

        //排序
        $orderBy['date'] = SORT_DESC;
//        print_r($orderBy);exit;
        $query->orderBy($orderBy);
        //分页
        Tools::constructPage($query, $params);
        return $query->all();
    }

    public function delete($id) {
        if (empty($id)) {
            $this->errMsg = '参数id不能为空';
            return false;
        }
        $model = AsdDiary::find()->where(['is_delete'=>0, 'id'=>$id])->one();
        if (empty($model)) {
            $this->errMsg = '参数id不正确';
            return false;
        }

        $model->is_delete = 1;
        if (!$model->save()) {
            $this->errMsg = array_values($model->getFirstErrors())[0];
            return false;
        }

        return true;
    }

    public static function getTitle($date, $title = '') {
        if (!empty($title)) {
            return $title;
        }

        $weekDays = ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'];
        $time = strtotime(date('Y-m-d', strtotime($date)));
        $title = date('Y年m月d日', $time) . ' ' . $weekDays[date('w',$time)];

        return $title;
    }
}