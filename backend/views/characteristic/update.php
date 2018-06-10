<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Characteristic */

$this->title = 'Actualizar Característica';
$this->params['breadcrumbs'][] = ['label' => 'Características', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="characteristic-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
