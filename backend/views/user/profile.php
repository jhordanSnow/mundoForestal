<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Perfil';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
  <div class="content row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">Actualizar datos</div>
        <div class="panel-body">
          <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
          <?= $form->field($model, 'lastname')->textInput(['autofocus' => true]) ?>
          <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
          <?= Html::hiddenInput('profile', 'true'); ?>
          <?= $form->field($model, 'email') ?>
        </div>
      </div>
      <div class="form-group">
          <?= Html::submitButton('Guardar datos', ['class' => 'btn btn-success']) ?>
      </div>
    </div>
    <?php $form = ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(['action' =>['user/reset-password'], 'method' => 'post',]); ?>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">Cambiar contrasña</div>
        <div class="panel-body">
          <?= $form->field($modelPass, 'currentPassword')->passwordInput(['autofocus' => true]) ?>
          <?= $form->field($modelPass, 'newPassword')->passwordInput(['autofocus' => true]) ?>
          <?= $form->field($modelPass, 'newPasswordConfirm')->passwordInput(['autofocus' => true]) ?>
        </div>
      </div>
      <div class="form-group">
          <?= Html::submitButton('Cambiar contraseña', ['class' => 'btn btn-success']) ?>
      </div>
    </div>
    <?php $form = ActiveForm::end(); ?>
  </div>
</div>
