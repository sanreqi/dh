<?php

namespace common\assets;

use yii\web\AssetBundle;

class DateTimePickerAsset extends AssetBundle
{
    public $sourcePath = '@common/assets';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $css = [
        'datetimepicker/jquery.datetimepicker.css'
    ];

    public $js = [
        'datetimepicker/build/jquery.datetimepicker.full.js'
    ];

    public $depends = [
        'common\assets\JqueryAsset'
    ];
}