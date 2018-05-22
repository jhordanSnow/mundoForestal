<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Planttype */

$this->title = 'Update Planttype: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Planttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->IdType]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="planttype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
