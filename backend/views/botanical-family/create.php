<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BotanicalFamily */

$this->title = 'Nueva Familia Botánica';
$this->params['breadcrumbs'][] = ['label' => 'Familias Botánicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="botanical-family-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
