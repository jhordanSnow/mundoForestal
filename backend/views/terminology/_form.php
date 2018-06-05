<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Terminology */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="terminology-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-8">
          <?= $form->field($model, 'Term')->textInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'Definition')->textarea(['rows' => 12]) ?>
          <?php
          $path = Url::base() . '/Images/';
          $path .= ($model->Photo == null) ? "noImage.png" : $model->Photo;
          ?>
        </div>
        <div class="col-md-4">
          <?= $form->field($model, 'imageFile')->fileInput(['id' => 'uploadAnswer']) ?>
          <img src="<?= $path ?>" class="img-responsive" id="imageTarget" />
        </div>
      </div>
    </div>
    <div class="form-group">
      <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php $form = ActiveForm::end(); ?>
</div>
