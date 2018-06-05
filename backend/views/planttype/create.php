<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Planttype */

$this->title = 'Nuevo Tipo de planta';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de plantas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planttype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
