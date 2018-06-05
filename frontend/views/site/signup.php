<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Registrarse';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
  <div class="container container-text">
    <div class="site-about">
      <div class="row">
        <div class="col-md-12" style="text-align: center;">
          <h1 class="title"><?= Html::encode($this->title) ?></h1>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="row">
          <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
          </div>
          <div class="col-md-6">
            <?= $form->field($model, 'lastname')->textInput(['autofocus' => true]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
          </div>
          <div class="col-md-6">
            <?= $form->field($model, 'email') ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?= $form->field($model, 'password')->passwordInput() ?>
          </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Registrarse', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
