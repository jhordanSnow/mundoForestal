<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BotanicalFamilySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Botanical Families';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="botanical-family-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Botanical Family', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'IdFamily',
            'Name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
