<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\QuestionCategory */

$this->title = 'Actualizar Categoría';
$this->params['breadcrumbs'][] = ['label' => 'Categorias de consultas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-category-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
