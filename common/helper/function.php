<?php

use yii\base\Model;

function getModelError(Model $model) {
    if (empty($model->getFirstErrors())) {
        return '';
    }

    $errors = array_values($model->getFirstErrors());
    return $errors[0];
}

function getRandString($length = 6) {
    $str = '012345678abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $max = strlen($str) - 1;
    $result = '';
    for ($i=0; $i<$length; $i++) {
        $rand = mt_rand(0, $max);
        $result .= substr($str, $rand, 1);
    }
    return $result;
}

//分页 //@todo srq
public static function constructPage($query,$params)
{
    if (isset($params['page']) && isset($params['pageSize'])) {
        $page = intval($params['page']);
        $pageSize = intval($params['pageSize']);
        $offset = ($page - 1) * $pageSize;
        $limit = $pageSize;
        $query->offset($offset)->limit($limit);
    }
    if (isset($params['page']) && isset($params['per-page'])) {
        $page = intval($params['page']);
        $pageSize = intval($params['per-page']);
        $offset = ($page - 1) * $pageSize;
        $limit = $pageSize;
        $query->offset($offset)->limit($limit);
    }
    return $query;
}