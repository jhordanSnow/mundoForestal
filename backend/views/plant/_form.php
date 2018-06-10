<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\widgets\Select2;
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
            <div class="row">
              <div class="col-md-10">
                <?= $form->field($model, 'IdFamily')->widget(Select2::classname(), [
                  'data' => $familyList,
                  'options' => ['placeholder' => 'Seleccione una familia botánica'],
                ]); ?>
              </div>
              <div class="col-md-2" style="padding-top: 25px;">
                <?= Html::button('', ['value' => Url::to(['botanical-family/create']), 'class' => 'btn btn-success glyphicon glyphicon-plus modalButton']) ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10">
                <?= $form->field($model, 'IdType')->widget(Select2::classname(), [
                  'data' => $typeList,
                  'options' => ['placeholder' => 'Seleccione un tipo de planta'],
                ]); ?>
              </div>
              <div class="col-md-2" style="padding-top: 25px;">
                <?= Html::button('', ['value' => Url::to(['planttype/create']), 'class' => 'btn btn-success glyphicon glyphicon-plus modalButton']) ?>
              </div>
            </div>
            <?= $form->field($model, 'Description')->textarea(['rows' => 19]) ?>
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
                <?= Html::button('', ['value' => Url::to(['characteristic/create']), 'class' => 'btn btn-success glyphicon glyphicon-plus modalButton']) ?>
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
              <div id="panel-characteristics" class="panel-body" style="max-height: 200px;overflow-y: auto;">

                <?php foreach ($model->plantcharacteristics as $plantChar) { ?>
                  <div class="row row-characteristic" id="characteristic_id_<?= $plantChar["IdCharacteristic"] ?>">
                  <input type="hidden" id="characteristic_value_<?= $plantChar["IdCharacteristic"] ?>" name="PlantCharacteristic[Value][]" value="<?= $plantChar["Value"] ?>">
                  <input type="hidden" id="characteristic_value_desc_<?= $plantChar["IdCharacteristic"] ?>" value="<?= $plantChar->characteristic["Name"] ?>">
                  <input type="hidden" name="PlantCharacteristic[IdCharacteristic][]" value="<?= $plantChar["IdCharacteristic"] ?>">
                  <div class="col-md-11"><?= $plantChar->characteristic["Name"] ?>: <?= $plantChar["Value"] ?></div>
                  <div class="col-md-1"><span class="glyphicon glyphicon-edit" onclick="removeOption(<?= $plantChar["IdCharacteristic"] ?>)" aria-hidden="true"></span></div>
                  </div>

                <?php } ?>

              </div>
            </div>

          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <div id="hiddenInfo" style="visibility: hidden;">
              <?php foreach ($model->mapinformations as $map) {
                echo '<input type="hidden" name="MapInformation[Polygon][]" value="'.$map->Polygon.'">';
              } ?>
            </div>
            <div id="map" style="height: 420px;width: 100%;"></div>
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
</div>

<?php
Modal::begin([
    'id' => 'modal',
    'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>

<?php ActiveForm::end(); ?>

<script>
  polygons = []
  var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 9.955295197063872, lng: -84.10939548338763},
      zoom: 8
    });

    var drawingManager = new google.maps.drawing.DrawingManager({
      drawingMode: google.maps.drawing.OverlayType.POLYGON,
      drawingControl: true,
      drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_CENTER,
        drawingModes: ['polygon']
      },
      polygonOptions: {
        fillColor: '#006d32',
        fillOpacity: 0.5,
        strokeWeight: 2,
        editable: true,
      }

    });

    <?php
    foreach ($model->mapinformations as $map) {
      ?>
      var polygonCustom = new google.maps.Polygon({
          paths: [<?= $map->Polygon ?>],
          fillColor: '#006d32',
          fillOpacity: 0.5,
          strokeWeight: 1,
          editable: true,
        });
        polygons.push(polygonCustom);
        google.maps.event.addListener(polygonCustom.getPath(), 'set_at', function(){polygonsToString()});
        google.maps.event.addListener(polygonCustom.getPath(), 'insert_at', function() {polygonsToString();});
        polygonCustom.setMap(map);
      <?php
    }
    ?>

      var homeControlDiv = document.createElement('div');
      var homeControl = new HomeControl(homeControlDiv, map);
      homeControlDiv.index = 1;
      map.controls[google.maps.ControlPosition.TOP_CENTER].push(homeControlDiv);


    google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
      polygons.push(polygon);
      polygonsToString();
      google.maps.event.addListener(polygon.getPath(), 'set_at', function(){polygonsToString()});
      google.maps.event.addListener(polygon.getPath(), 'insert_at', function() {polygonsToString();});
    });

    drawingManager.setMap(map);
  }

  function polygonsToString(){
    var mapinfo = $("#hiddenInfo");
    mapinfo.html('');
    for (var i =0; i < polygons.length; i++) {
      var polyString = ''
      for (var j =0; j < polygons[i].getPath().getLength(); j++) {
        var xy = polygons[i].getPath().getAt(j);
        polyString += '{lat: '+xy.lat()+', lng: '+xy.lng()+'},';
      }
      mapinfo.append('<input type="hidden" name="MapInformation[Polygon][]" value="'+polyString+'">')
    }
  }


//To set CSS and handling event for the control
    function HomeControl(controlDiv, map) {
        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.height = '23px';
        controlUI.style.marginTop = '5px';
        controlUI.style.marginLeft = '-5px';
        controlUI.style.paddingTop = '1px';
        controlUI.style.cursor = 'pointer';
        controlUI.title = 'Deshacer';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.padding = '5px 8px';
        controlText.innerHTML = '<i class="fa fa-remove"></i>';
        controlText.style.color = '#000';
        controlUI.appendChild(controlText);

        // Setup the click event listeners
        google.maps.event.addDomListener(controlUI, 'click', function () {
          if (polygons.length > 0){
            var last = polygons.length - 1
            polygons[last].setMap(null);
            polygons.pop();
            polygonsToString();
          }
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8-P_bjNBgNPzVrTKHnFpEyB_yexBOrnk&libraries=drawing&callback=initMap"></script>
