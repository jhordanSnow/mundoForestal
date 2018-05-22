<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CharacteristicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Characteristics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Characteristic', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'IdCharacteristic',
            'Name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
