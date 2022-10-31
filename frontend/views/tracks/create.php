<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tracks $model */

$this->title = 'Create Tracks';
$this->params['breadcrumbs'][] = ['label' => 'Tracks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
