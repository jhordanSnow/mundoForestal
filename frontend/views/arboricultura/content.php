<?php

use yii\helpers\Html;

$this->title = $model->Title;
$this->params['breadcrumbs'][] = $model->Title;
?>

<div class="container container-text">
  <div class="content">
    <div class="row">
      <div class="col-md-12" style="text-align: center;">
        <h1 class="title"><?= Html::encode($model->Title) ?></h1>
      </div>
      <div class="content-page">
        <?= $model->Data ?>
      </div>
    </div>
  </div>
</div>
