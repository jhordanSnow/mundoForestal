<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\QuestionCategory;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consultas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
                'style'=>'overflow: auto; word-wrap: break-word;'
        ],
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          [
            'label' => 'Usuario',
            'value' => function($model) { return $model->user->name  . " " . $model->user->lastname ;},
          ],
          [
            'label' => 'Categoría',
            'attribute' => 'IdCategory',
            'value' => 'category.Name',
            'filter'=>ArrayHelper::map(QuestionCategory::find()->asArray()->all(), 'IdCategory', 'Name'),
          ],
          [
            'attribute' => 'state',
            'label' => 'Estado',
            'filter'=>array(0 => 'Sin publicar', 1 => 'Publicada'),
            'value' => function($model) { return ($model->state == 0) ? 'Sin publicar': 'Publicada';},
          ],
          [
            'label' => 'Pregunta',
            'attribute' => 'Question',
            'filter' => false,
          ],
          [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{answer} {state}',
            'buttons' => [
              'answer' => function ($url) { return Html::a('<span class="glyphicon glyphicon-send"></span>',$url,['title' => 'Responder','data-pjax' => '0',]);},
              'state' => function ($url, $model) {
                return ($model->state == 0) ?
                  Html::a('<span class="glyphicon glyphicon-ok"></span>', ['activate', 'id' => $model->IdQuestion] , ['title' => 'Publicar','data' => ['confirm' => 'Realmente desea publicar esta consulta?']]) :
                  Html::a('<span class="glyphicon glyphicon-remove"></span>', ['deactivate', 'id' => $model->IdQuestion] , ['title' => 'Ocultar','data' => ['confirm' => 'Realmente desea ocultar esta consulta?']]);
              },
            ]
          ],
        ],
    ]); ?>
</div>
