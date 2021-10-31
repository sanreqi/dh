<?php


namespace backend\assets;


use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/css/login.css?v=5',
    ];

    public $depends = [
        'common\assets\BootstrapV4Asset',
    ];
}