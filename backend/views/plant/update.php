<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Plant */

$this->title = 'Update Plant: '. $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Plants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->IdPlant]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plant-update">
    <?= $this->render('_form', [
        'model' => $model,
        'modelChar' => $modelChar,
        'modelPhoto' => $modelPhoto,
        'typeList' => $typeList,
        'familyList' => $familyList,
        'characteristicList' => $characteristicList
    ]) ?>

</div>
