<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $css = [
        'static/css/dashbord.css?v=3',
    ];
    public $js = [
        'static/js/function.js?v=3'
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
        'common\assets\BootstrapV4Asset'
    ];
}
