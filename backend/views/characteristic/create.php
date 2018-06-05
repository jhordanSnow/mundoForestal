<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Characteristic */

$this->title = 'Nueva Característica';
$this->params['breadcrumbs'][] = ['label' => 'Características', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
