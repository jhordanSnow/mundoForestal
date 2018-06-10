<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Characteristic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="characteristic-form">

    <?php $form = ActiveForm::begin(['options'=> ['class' => 'char-form'],]); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS

$('.char-form').submit(function(e) {
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
             if (data.success){
               $('#modal').modal('toggle');
               var newOption = new Option(data.Name, data.IdCharacteristic, false, false);
               $('#characteristic_id').append(newOption);
               $('#characteristic_id').val(data.IdCharacteristic).trigger('change');
             }
        },
        error: function () {
            alert("Error de conexión");
        }
    });
    e.preventDefault();
})
JS;
$this->registerJS($script);
?>
