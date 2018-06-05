<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CharacteristicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Características';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-index">
    <p>
        <?= Html::a('Nueva característica', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Name',
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
