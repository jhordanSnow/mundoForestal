<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Planttype */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planttype-form">

    <?php $form = ActiveForm::begin(['options'=> ['class' => 'plattype-form'],]); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = <<< JS

$('.plattype-form').submit(function(e) {
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (data) {
             if (data.success){
               $('#modal').modal('toggle');
               var newOption = new Option(data.Name, data.IdType, false, false);
               $('#plant-idtype').append(newOption);
               $('#plant-idtype').val(data.IdType).trigger('change');
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
