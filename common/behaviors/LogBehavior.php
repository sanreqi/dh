<?php
namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;

class LogBehavior  extends Behavior
{
    public function events()
    {
        [BaseActiveRecord::EVENT_AFTER_INSERT => 'afterInsert'],
        [BaseActiveRecord::EVENT_AFTER_INSERT => 'afterInsert'],

//        [],

    }

    public function nangdai() {

    }
}