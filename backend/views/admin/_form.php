<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="admin-form">
  <div class="panel panel-default">
    <div class="panel-body row">

        <div class="col-md-6">
          <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'lastname')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'password')->passwordInput() ?>
        </div>

    </div>
  </div>
  <div class="form-group">
      <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  </div>
</div>
<?php ActiveForm::end(); ?>
