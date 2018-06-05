<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BotanicalFamily */

$this->title = 'Actualizar Familia Botánica';
$this->params['breadcrumbs'][] = ['label' => 'Familias Botánicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="botanical-family-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
