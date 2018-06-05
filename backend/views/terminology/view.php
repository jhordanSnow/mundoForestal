<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Terminology */

$this->title = $model->IdTerminology;
$this->params['breadcrumbs'][] = ['label' => 'Terminologies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terminology-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->IdTerminology], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->IdTerminology], [
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
            'IdTerminology',
            'Term',
            'Definition',
            'Photo',
        ],
    ]) ?>

</div>
