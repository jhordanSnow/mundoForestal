<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Terminology */

$this->title = 'Nuevo término';
$this->params['breadcrumbs'][] = ['label' => 'Términos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terminology-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
