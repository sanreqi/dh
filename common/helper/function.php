<?php

use yii\base\Model;

function getModelError(Model $model) {
    if (empty($model->getFirstErrors())) {
        return '';
    }

    $errors = array_values($model->getFirstErrors());
    return $errors[0];
}