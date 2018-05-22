<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BotanicalFamily */

$this->title = 'Create Botanical Family';
$this->params['breadcrumbs'][] = ['label' => 'Botanical Families', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="botanical-family-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
