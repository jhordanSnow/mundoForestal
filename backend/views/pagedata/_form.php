<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
?>

<script>
var CKEDITOR_BASEPATH = '../../vendor/ckeditor/ckeditor/';
</script>

<div class="pagedata-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Data')->widget(CKEditor::className(), [
      		'options' => ['rows' => 6],
      		'preset' => 'full'
      	])
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
