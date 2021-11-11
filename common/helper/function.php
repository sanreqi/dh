<?php

use yii\base\Model;

/**
 * 随机数
 * @param int $length
 * @return string
 */
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

/**
 * 验证身份证
 * @return bool
 */
function checkIdentity($idCard) {
    $set = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
    $ver = array('1', '0', 'x', '9', '8', '7', '6', '5', '4', '3', '2');
    $arr = str_split($idCard);
    $sum = 0;
    for ($i = 0; $i < 17; $i++){
        //modify by srq at 2021-08-11
        if (!isset($arr[$i])) {
            return false;
        }
        if (!is_numeric($arr[$i])){
            return false;
        }
        $sum += $arr[$i] * $set[$i];
    }
    $mod = $sum % 11;
    if (strcasecmp($ver[$mod], $arr[17]) != 0){
        return false;
    }
    return true;
}