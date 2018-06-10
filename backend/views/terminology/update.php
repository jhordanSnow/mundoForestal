<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Terminology */

$this->title = 'Actualizar Término';
$this->params['breadcrumbs'][] = ['label' => 'Términos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="terminology-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
