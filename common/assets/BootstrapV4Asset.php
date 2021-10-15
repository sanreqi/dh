<?php

namespace common\assets;

use yii\web\AssetBundle;

class BootstrapV4Asset extends AssetBundle
{
    public $sourcePath = '@common/assets';
    public $css = [
        'css/bootstrap.min.css',
    ];

    public $js = [
        'js/bootstrap.min.js?v=1'
    ];

    public $depends = [
        'yii\web\YiiAsset'
    ];


}