<?php

namespace backend\components;

use Yii;
use common\services\RbacService;

class Menu
{
    //加3个属性
    public static function getMenuItem() {
        $menus = Yii::$app->params['menu'];
        foreach ($menus as &$v1) {
            $v1[0]['show'] = '';
            foreach ($v1 as $k2 => &$v2) {
                $v2['hide'] =  RbacService::getMenuItemHideCss($v2['path']);
                //$k2==0是每一项第一行item
                if ($k2 != 0) {
                    $v2['checked'] = RbacService::getMenuItemCheckedCss($v2['path']);
                    if (!empty($v2['checked'])) {
                        $v1[0]['show'] = 'show';
                    }
                }
            }
        }

        return $menus;
    }
}