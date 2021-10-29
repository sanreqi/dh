<?php
namespace backend\components;

use yii\base\Component;

class Foo extends Component
{
    const EVENT_HELLO = 'EVENTTEST';

//    const EVENT_BYE = 'bye';

    public function hello($event) {
        echo "Hello XX\n";
        print_r($event->data);
        echo "\n";
    }

    public function bye() {
        echo "Bye XX\n";
    }

    public function bar()
    {
        echo 'bar hello';
//        $this->trigger(self::EVENT_HELLO);
    }
}