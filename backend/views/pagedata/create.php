<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Pagedata */

$this->title = 'Nuevo Contenido';
$this->params['breadcrumbs'][] = ['label' => 'Contenido', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagedata-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
