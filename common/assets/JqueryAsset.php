<?php
namespace common\assets;

use yii\web\AssetBundle;

class JqueryAsset extends AssetBundle
{
    public $sourcePath = '@common/assets';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [

    ];

    public $js = [
        'js/jquery2.0.2.min.js'
    ];

    public $depends = [

    ];
}