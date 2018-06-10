<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Plant */

$this->title = 'Nueva Planta';
$this->params['breadcrumbs'][] = ['label' => 'Plantas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plant-create">
    <?= $this->render('_form', [
        'model' => $model,
        'modelChar' => $modelChar,
        'modelPhoto' => $modelPhoto,
        'modelMap' => $modelMap,
        'typeList' => $typeList,
        'familyList' => $familyList,
        'characteristicList' => $characteristicList
    ]) ?>
</div>
