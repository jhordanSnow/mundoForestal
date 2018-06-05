<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Plant */

$this->title = 'Actualizar Planta';
$this->params['breadcrumbs'][] = ['label' => 'Plantas', 'url' => ['index']];
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
