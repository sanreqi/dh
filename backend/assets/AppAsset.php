<?php

namespace backend\assets;

use common\assets\DateTimePickerAsset;
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
        'static/css/dashbord.css?v=2111112231',
    ];
    public $js = [
        'static/js/function.js?v=111222223',
        'static/js/ajaxfileupload.js?v=6',
    ];
    public $depends = [
        'common\assets\BootstrapV4Asset',
    ];
}
