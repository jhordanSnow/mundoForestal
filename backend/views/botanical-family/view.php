<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BotanicalFamily */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Botanical Families', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="botanical-family-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->IdFamily], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->IdFamily], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'IdFamily',
            'Name',
        ],
    ]) ?>

</div>
