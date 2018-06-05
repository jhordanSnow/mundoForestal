<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuestionCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias de consultas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-category-index">

    <p>
        <?= Html::a('Nueva categoría', ['create'], ['class' => 'btn btn-success']) ?>
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
