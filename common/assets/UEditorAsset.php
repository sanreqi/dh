<?php

namespace common\assets;

use yii\web\AssetBundle;

class UEditorAsset extends AssetBundle
{
    public $sourcePath = '@common/assets';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [

    ];

    public $js = [
        //顺序不能错
        'ueditor/ueditor.config.js?v=1',
        'ueditor/ueditor.all.min.js',
    ];

    public $depends = [

    ];
}