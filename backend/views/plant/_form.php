<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Plant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plant-form">
  <div class="panel-group">
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'ScientificName')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'IdFamily')->widget(Select2::classname(), [
              'data' => $familyList,
              'options' => ['placeholder' => 'Seleccione una familia botánica'],
            ]); ?>
            <?= $form->field($model, 'IdType')->widget(Select2::classname(), [
              'data' => $typeList,
              'options' => ['placeholder' => 'Seleccione una familia botánica'],
            ]); ?>
            <?= $form->field($model, 'Description')->textarea(['rows' => 6]) ?>
            <div class="form-group">
              <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-10">
                <?= Html::label('Característica', 'characteristic_id') ?>
                <?= Select2::widget([
                    'name' => 'characteristic_id',
                    'id' => 'characteristic_id',
                    'value' => '',
                    'data' => $characteristicList,
                    'options' => ['placeholder' => 'Seleccione una caracteristica'],
                ]); ?>
              </div>
              <div class="col-md-2" style="margin-top: 23px;">
                <button type="button" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
              </div>
            </div>

            <div class="row">
              <div class="col-md-10">
                <?= Html::label('Valor', 'valor_add') ?>
                <?= Html::textInput('valor_add', '', ['class' => 'form-control', 'id' => 'valor_add']) ?>
              </div>
              <div class="col-md-2" style="margin-top: 23px;">
                <button type="button" class="btn btn-info" onclick="caca()">
                    <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                </button>
              </div>

            </div>

            <div class="panel">
              <div id="panel-characteristics" class="panel-body" style="max-height: 100px;overflow-y: auto;"></div>
            </div>

          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">Mapa</div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading" id="filecontainer">Fotos
            <?= Html::fileInput('Photo[]','',['multiple' => true,'id'=>'uploadFiles','class'=>'pull-right','accept'=>'.jpg,.jpeg,.png']) ?>
          </div>
          <div class="panel-body" id="contentImages"></div>
        </div>
      </div>
    </div>
  </div>
</div
