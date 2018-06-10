<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\bootstrap\Carousel;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

$this->title = 'Plantas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container container-text">

  <div class="panel panel-success">
    <div class="panel-heading">
      <div class="row">
        <div class="col-md-10">
          <h3>Filtros</h3>
        </div>
        <div class="col-md-2">
          <button data-toggle="collapse" data-target="#panel-container" class="btn pull-right" style="background: #006d32;"></button>
        </div>
      </div>
    </div>
    <div class="panel-body collapse" id="panel-container">
      <?php $form = ActiveForm::begin(['method' => 'get']) ?>
      <div class="row form-group" style="padding-top: 20px;">
        <div class="col-md-3">
          <?= Html::label('Nombre', 'Name') ?>
          <?= Html::textInput('Name', Yii::$app->getRequest()->getQueryParam('Name'), ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-3">
          <?= Html::label('Nombre cientifico', 'ScientificName') ?>
          <?= Html::textInput('ScientificName', Yii::$app->getRequest()->getQueryParam('ScientificName'), ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-3">
          <?= Html::label('Familia botánica', 'IdFamily') ?>
          <?= Select2::widget([
            'name' => 'IdFamily',
            'value' => Yii::$app->getRequest()->getQueryParam('IdFamily'),
            'data' => $familyList,
            'options' => ['placeholder' => 'Seleccione una familia botánica'],
          ]); ?>
        </div>
        <div class="col-md-3">
          <?= Html::label('Tipo de planta', 'IdType') ?>
          <?= Select2::widget([
            'name' => 'IdType',
            'value' => Yii::$app->getRequest()->getQueryParam('IdType'),
            'data' => $typeList,
            'options' => ['placeholder' => 'Seleccione un tipo de planta'],
          ]); ?>
        </div>
        <div class="col-md-3" style="padding-top: 20px">
          <?= Html::submitButton('Filtrar', ['class'=> 'btn btn-success']); ?>
          <?= Html::a('Limpiar', ['/arboricultura/search-plant'], ['class' => 'btn btn-success']) ?>
        </div>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>

  <div class="site-about">
    <div class="row">

    <?php
    if (count($plants) == 0){ ?>
      <div class="no-record">;
        <h1 class="title">No se encontraron resultados. </h1><br />
        <img class="img-responsive" src="../../<?=Yii::$app->urlManagerBackend->baseUrl?>/noRecord.png"/>
      </div>
    <?php }else{

      foreach ($plants as $plant) {
        $items = [];
        foreach ($plant->photos as $photo) {
           $items[] = '<img onclick="showImage(this)" class="img-responsive" src="../../'.Yii::$app->urlManagerBackend->baseUrl.'/'.$photo->Photo.'"/>';
        }
        foreach ($plant->mapinformations as $map) {
          echo '<input type="hidden" value="'.$map->Polygon.'" class="MapInfo" IdPlant="'.$plant->IdPlant.'" />';
        }
      ?>
        <div class="col-md-12 row row-plant">
          <div class="row">
            <div class="col-md-11">
              <h2 class="title"><?= $plant->Name ?></h2>
              <h2 class="title small-title">Nombre científico: <i><?= $plant->ScientificName ?></i></h2>
              <h2 class="title small-title">Familia botánica: <b><?= $plant->family->Name ?></b></h2>
            </div>
            <div class="col-md-1">
              <?php if (count($plant->mapinformations) > 0){ ?>
              <img class="img-responsive show-map" IdPlant="<?=$plant->IdPlant?>" style="cursor:pointer;padding: 5px;max-height: 50px" src="../../<?=Yii::$app->urlManagerBackend->baseUrl?>/location.png"/>
              <?php } ?>
            </div>
          </div>
          <br />
           <div class="col-md-3">
             <?= Carousel::widget([
               'options' => ['class' => 'row-carousel'],
               'items' => $items,
             ]);?>
           </div>
           <div class="row">
             <div class="row col-md-9 plant-char">
               <?php foreach ($plant->plantcharacteristics as $char) { ?>
                 <div class="col-md-3">
                   <?= $char->characteristic->Name ?> : <?= $char->Value ?>
                 </div>
               <?php } ?>
             </div>
             <?= nl2br($plant->Description) ?>
           </div>
        </div>
      <?php }} ?>
    </div>
    <div class="pagination-container">
      <?= LinkPager::widget(['pagination' => $pages]); ?>
    </div>
  </div>
</div>

<?php
Modal::begin([
    'id' => 'modalMap',
    'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div><div id='map' style='min-height: 500px;'></div>";
Modal::end();
?>

<?php

$script = <<< JS

  $('.show-map').click(function(){
    $('#modalMap').modal('show').find('#modalContent').html("");
    setMapOnAll();
    $('#map').show();
    $('#modalMap').modal('show');
    for (var i = 0; i < polygons[23].length; i++) {
      polygons[$(this).attr('IdPlant')][i].setMap(map);
    }
  });

  function setMapOnAll(){
    for (var i = 0; i < polygons.length; i++) {
      if(typeof polygons[i] !== "undefined"){
        for (var j = 0; j < polygons[i].length; j++) {
          polygons[i][j].setMap(null);
        }
      }
    }
  }

JS;

$this->registerJS($script);
?>

<script>
var map;
var polygons = [];

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 9.955295197063872, lng: -84.10939548338763},
    zoom: 8
  });

  <?php
  foreach ($plants as $plant) {?>
    polygons[<?=$plant->IdPlant?>] = []
    <?php foreach ($plant->mapinformations as $map) {
    ?>
    var polygonCustom = new google.maps.Polygon({
        paths: [<?= $map->Polygon ?>],
        fillColor: '#006d32',
        fillOpacity: 0.5,
        strokeWeight: 1,
      });
      polygons[<?=$plant->IdPlant?>].push(polygonCustom);
    <?php
  }}
  ?>

}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8-P_bjNBgNPzVrTKHnFpEyB_yexBOrnk&callback=initMap"></script>
