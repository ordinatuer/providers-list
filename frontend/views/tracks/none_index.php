<?php

use common\models\Tracks;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tracks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr><hr><hr><hr>
    <pre>
        <?php print_r($message);?>
    </pre>
    <hr><hr><hr><hr>
</div>
