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
        'static/css/dashbord.css?v=4',
    ];
    public $js = [
        'static/js/function.js?v=3',
        'static/js/ajaxfileupload.js?v=5',
    ];
    public $depends = [
        'common\assets\BootstrapV4Asset',
    ];
}
