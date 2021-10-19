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