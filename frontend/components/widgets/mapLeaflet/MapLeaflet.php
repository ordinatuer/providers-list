<?php

namespace frontend\components\widgets\mapLeaflet;

use yii\base\Widget;
use yii\web\View;
use frontend\components\widgets\mapLeaflet\assets\LeafletAsset;

class MapLeaflet extends Widget
{
    public $model;

    public function init()
    {
        $js = <<< JS
            var providers = JSON.parse('{$this->model}');
        JS;
        $this->view->registerJs($js, View::POS_BEGIN);

        LeafletAsset::register($this->view);
    }

    public function run()
    {
        return $this->render('map');
    }
}