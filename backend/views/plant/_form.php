<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\layers\BicyclingLayer;
use dosamigos\google\maps\Event;

/* @var $this yii\web\View */
/* @var $model backend\models\Plant */
/* @var $form yii\widgets\ActiveForm */
$coord = new LatLng(['lat' => 9.9333300, 'lng' => -84.0833300]);
$coords = [];
$map = new Map([
    'center' => $coord,
    'zoom' => 8,
    'height' => 420,
    'polygon' => new Polygon(['paths' => $coords]),
]);


//$polygon->attachInfoWindow(new InfoWindow(['content' => '<p>This is my super cool Polygon</p>']));

$event = new Event(["trigger"=>"click","js"=>"fnCaca(this)"]);
$map->addEvent($event);
?>
<?php $form = ActiveForm::begin(); ?>
<div class="plant-form">
  <div class="panel-group">
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
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
            <?= $form->field($model, 'Description')->textarea(['rows' => 18]) ?>
            <div class="form-group">
              <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
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
              <div id="panel-characteristics" class="panel-body" style="max-height: 100px;overflow-y: auto;">

                <?php foreach ($model->plantcharacteristics as $plantChar) { ?>
                  <div class="row row-characteristic" id="characteristic_id_<?= $plantChar["IdCharacteristic"] ?>">
                  <input type="hidden" id="characteristic_value_<?= $plantChar["IdCharacteristic"] ?>" name="PlantCharacteristic[Value][]" value="<?= $plantChar["Value"] ?>">
                  <input type="hidden" id="characteristic_value_desc_<?= $plantChar["IdCharacteristic"] ?>" value="<?= $plantChar->characteristic["Name"] ?>">
                  <input type="hidden" name="PlantCharacteristic[IdCharacteristic][]" value="<?= $plantChar["IdCharacteristic"] ?>">
                  <div class="col-md-11"><?= $plantChar->characteristic["Name"] ?>: <?= $plantChar["Value"] ?></div>
                  <div class="col-md-1"><span class="glyphicon glyphicon-remove" onclick="removeOption(<?= $plantChar["IdCharacteristic"] ?>)" aria-hidden="true"></span></div>
                  </div>

                <?php } ?>

              </div>
            </div>

          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <?= $map->display(); ?>
          </div>
        </div>
      </div>
      <div class="col-md-12" style="margin-top: 10px;">
        <div class="panel panel-default">
          <div class="panel-heading" id="filecontainer"><?= $form->field($modelPhoto, 'photos[]')->fileInput(['multiple' => true,'id'=>'uploadFiles','class'=>'pull-right','accept'=>'.jpg,.jpeg,.png']) ?>
          </div>
          <div class="panel-body" id="contentImages">
            <?php
            $path = Yii::getAlias('@web'). '/Images/';
            $fileNames = "";
            foreach ($model->photos as $photo) { ?>
              <div class='col-md-3' style='overflow: hidden; height: 250px;margin-bottom:10px;'>
                <a class='fa fa-remove btn btn-danger' style='float:right;position: absolute;' OnClick='deleteImage(this)' element-name='<?=$photo->Photo?>'></a>
                <?php echo Html::img('@web/Images/'.$photo->Photo, ['class' => 'pull-left img-responsive']); ?>
              </div>
            <?php
              $fileNames .= $photo->Photo.",";
            } ?>
          </div>
          <input type="hidden" value="<?=$fileNames?>" name="uploadFilesNames" id="uploadFilesNames" />
        </div>
      </div>
    </div>
  </div>
</div
<?php ActiveForm::end(); ?>
