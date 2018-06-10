<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pagedata */

$this->title = 'Actualizar Contenido';
$this->params['breadcrumbs'][] = ['label' => 'Contenido', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="pagedata-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
