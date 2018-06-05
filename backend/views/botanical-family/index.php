<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BotanicalFamilySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Familias Botánicas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="botanical-family-index">
    <p>
        <?= Html::a('Nueva familia botánica', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Name',
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
