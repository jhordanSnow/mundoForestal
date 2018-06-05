<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PlanttypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos de plantas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planttype-index">

    <p>
        <?= Html::a('Nuevo tipo de planta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
                'style'=>'overflow: auto; word-wrap: break-word;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Name',
            [
              'label' => 'Descripción',
              'attribute' => 'Description',
              'value' => function($model){ return ($model->Description == null) ? '' : substr($model->Description, 0, 420).' ...'; },
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
