<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BotanicalFamily */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="botanical-family-form">

    <?php $form = ActiveForm::begin(['options'=> ['class' => 'botanical-family-form'],]); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<?php
$script = <<< JS

$('.botanical-family-form').submit(function(e) {
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
             if (data.success){
               $('#modal').modal('toggle');
               var newOption = new Option(data.Name, data.IdFamily, false, false);
               $('#plant-idfamily').append(newOption);
               $('#plant-idfamily').val(data.IdFamily).trigger('change');
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
