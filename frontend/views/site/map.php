<?php

use frontend\components\widgets\mapLeaflet\MapLeaflet;

/** @var yii\web\View $this */

$this->title = 'Карта';

?>


<?= MapLeaflet::widget(['model' => $model])?>