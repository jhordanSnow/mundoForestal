<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TerminologySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Términos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terminology-index">

    <p>
        <?= Html::a('Nuevo Término', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Term',
            [
              'label' => 'Definición',
              'attribute' => 'Definition',
              'value' => function($model){ return ($model->Definition == null) ? '' : substr($model->Definition, 0, 420).' ...'; },
            ],

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
