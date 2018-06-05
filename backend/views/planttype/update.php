<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Planttype */

$this->title = 'Actualizar Tipo de planta';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de plantas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="planttype-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
