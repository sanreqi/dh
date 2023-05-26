<?php

namespace common\services;

use common\models\User;

class UserService
{
    public static function getNameByUid($uid) {
        $name = '';
        $model = User::find()->where(['status' => User::STATUS_ACTIVE, 'id' => $uid])->one();
        if (!empty($model)) {
            $name = $model->username;
        }

        return $name;
    }
}