<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Plant */

$this->title = 'Update Plant: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Plants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->IdPlant]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
