<?php

namespace frontend\components\widgets\mapLeaflet\assets;

use yii\web\AssetBundle;

class VueAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/vue.css',
    ];
    public $js = [
        'https://unpkg.com/vue@3.2.36/dist/vue.global.js',
        ['js/vueapp.js', 'type' => 'module'],
    ];
    public $depends = [];
}
