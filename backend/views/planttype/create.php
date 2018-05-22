<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Planttype */

$this->title = 'Create Planttype';
$this->params['breadcrumbs'][] = ['label' => 'Planttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planttype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
