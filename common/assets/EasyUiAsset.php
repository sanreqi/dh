<?php


namespace common\assets;


use yii\web\AssetBundle;

class EasyUiAsset extends AssetBundle
{
    public $sourcePath = '@common/assets';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $css = [
        'easyui/themes/default/easyui.css',
        'easyui/themes/icon.css',
    ];

    public $js = [
        'easyui/jquery.easyui.min.js',
    ];

    public $depends = [
        'common\assets\JqueryAsset'
    ];
}