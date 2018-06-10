<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PagedataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contenido';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagedata-index">
    <p>
        <?= Html::a('Nuevo Contenido', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
                'style'=>'overflow: auto; word-wrap: break-word;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Title',
            [
              'label' => 'Contenido',
              'attribute' => 'Data:ntext',
              'value' => function($model){ return ($model->Data == null) ? '' : substr($model->Data, 0, 420).' ...'; },
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
