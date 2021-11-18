<?php


namespace backend\assets;


use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $css = [
        'static/css/login.css?v=5',
    ];
    public $js = [
        'static/js/function.js?v=1',
    ];

    public $depends = [
        'common\assets\BootstrapV4Asset',
    ];
}