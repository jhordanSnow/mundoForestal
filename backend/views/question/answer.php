<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Responder';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer container-content">

<div class="panel panel-success">
  <div class="panel-heading">Consulta</div>
  <div class="panel-body">
    <?= $model->Question; ?>
  </div>
</div>

<?php $form = ActiveForm::begin(); ?>
<div class="panel panel-default">
  <div class="panel-body">
    <div class="col-md-8">
      <?= $form->field($modelAnswer, 'Answer')->textarea(['rows' => 12]) ?>
      <?php
      $path = Url::base() . '/Images/';
      $path .= ($modelAnswer->Photo == null) ? "noImage.png" : $modelAnswer->Photo;
      ?>
    </div>
    <div class="col-md-4">
      <?= $form->field($modelAnswer, 'imageFile')->fileInput(['id' => 'uploadAnswer']) ?>
      <img src="<?= $path ?>" class="img-responsive" id="imageTarget" />
    </div>
  </div>
</div>
<div class="form-group">
  <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php $form = ActiveForm::end(); ?>


</div>
