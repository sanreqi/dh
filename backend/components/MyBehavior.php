<?php
namespace backend\components;

use yii\base\Behavior;

class MyBehavior extends Behavior
{
    public $prop1;

    public function events()
    {
        return [
            'testE' => 'teSe'
        ];
    }

    private $_prop2;

    public function getProp2()
    {
        return $this->_prop2;
    }

    public function setProp2($value)
    {
        $this->_prop2 = $value;
    }

    public function foo()
    {
       print_r($this->owner);exit;
//        return static::class;
        // ...
    }

    public function teSe() {
//        echo 666; exit;
    }
}