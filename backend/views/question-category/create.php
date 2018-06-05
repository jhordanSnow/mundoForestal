<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\QuestionCategory */

$this->title = 'Nueva Categoría';
$this->params['breadcrumbs'][] = ['label' => 'Categorias de consultas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
