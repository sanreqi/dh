<?php


namespace backend\assets;


use yii\web\AssetBundle;

class JjjAsset  extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $css = [
        'static/css/jjj.css?v=2',
    ];
    public $js = [
        'static/js/jjj.js?v=2',
    ];

    public $depends = [
        'common\assets\JqueryAsset',
    ];
}