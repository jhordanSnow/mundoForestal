<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pagedata */

$this->title = $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Pagedatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagedata-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->IdData], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->IdData], [
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
            'IdData',
            'Title',
            'Data:ntext',
        ],
    ]) ?>

</div>
