<?php

namespace frontend\components\widgets\mapLeaflet\assets;

use yii\web\AssetBundle;

class LeafletAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://unpkg.com/leaflet@1.9.2/dist/leaflet.css',
        'css/map.css',
    ];
    public $js = [
        'https://unpkg.com/leaflet@1.9.2/dist/leaflet.js',
        // 'js/map.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
