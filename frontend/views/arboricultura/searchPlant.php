<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Carousel;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

$this->title = 'Plantas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="filter-options">
  <h3>Filtros</h3>
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
      <?= Html::submitButton('Filtrar', ['class'=> 'btn btn-primary']); ?>
      <?= Html::a('Limpiar', ['/arboricultura/search-plant'], ['class' => 'btn btn-primary']) ?>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</div>


<div class="container container-text">
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
      ?>
        <div class="col-md-12 row row-plant">
          <h2 class="title"><?= $plant->Name ?></h2>
          <h2 class="title small-title">Nombre científico: <i><?= $plant->ScientificName ?></i></h2>
          <h2 class="title small-title">Familia botánica: <b><?= $plant->family->Name ?></b></h2>
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
             <br />
             <?= nl2br($plant->Description) ?>
           </div>
        </div>
      <?php }} ?>
    </div>
    <?= LinkPager::widget(['pagination' => $pages]); ?>
  </div>
</div>


<div id="imageModal" class="modal modal-image">
  <span id="closeModal" class="close">&times;</span>
  <img class="modal-content">
</div>
