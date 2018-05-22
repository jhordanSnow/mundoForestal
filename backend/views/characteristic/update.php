<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Characteristic */

$this->title = 'Update Characteristic: '.$model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Characteristics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->IdCharacteristic]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="characteristic-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
