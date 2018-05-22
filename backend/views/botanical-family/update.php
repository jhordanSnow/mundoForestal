<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BotanicalFamily */

$this->title = 'Update Botanical Family: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Botanical Families', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->IdFamily]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="botanical-family-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
