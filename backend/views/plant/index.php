<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\Planttype;
use backend\models\Botanicalfamily;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PlantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Plantas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plant-index">

    <p>
        <?= Html::a('Nueva Planta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Name',
            'ScientificName',
            [
              'label' => 'Familia botánica',
              'attribute' => 'IdFamily',
              'value' => 'family.Name',
              'filter'=> ArrayHelper::map(BotanicalFamily::find()->asArray()->all(), 'IdFamily', 'Name'),
            ],
            [
              'label' => 'Tipo de planta',
              'attribute' => 'IdType',
              'value' => 'type.Name',
              'filter'=> ArrayHelper::map(PlantType::find()->asArray()->all(), 'IdType', 'Name'),
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
