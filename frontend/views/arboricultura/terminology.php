<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Carousel;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

$this->title = 'Consultorio del Dr Árbol';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container container-text">
  <div class="site-consultorio">
    <div class="row">
      <div class="col-md-3">
        <?= Html::label('Términos', 'IdTerminology') ?>
        <ul class="nav nav-tabs nav-stacked side-nav">
          <li></li>
          <?php
          foreach ($termList as $id => $term) {
            $class = (Yii::$app->getRequest()->getQueryParam('IdTerminology') == $id) ? 'actual' : '';
            ?>
            <li class="<?=$class?>"><a href="<?= Url::to(['/arboricultura/terminologia']); ?>&IdTerminology=<?=$id?>">
              <?= $term ?>
            </a></li>
          <?php } ?>
        </ul>
      </div>
      <div class="col-md-9 row">

        <?php
        if (count($terms) == 0){ ?>
          <div class="no-record">;
            <h1 class="title">No se encontraron resultados. </h1><br />
            <img class="img-responsive" src="../../<?=Yii::$app->urlManagerBackend->baseUrl?>/noRecord.png"/>
          </div>
        <?php }else{
          foreach ($terms as $term) {
          ?>
            <div class="col-md-12">
                <h2 class="title"><?= $term->Term ?></h2>
                <div class="texto-desc">
                  <img onclick="showImage(this)" class="little-image img-rounded img-responsive" src="../../<?=Yii::$app->urlManagerBackend->baseUrl?>/<?= $term->Photo ?>"/>
                  <?= $term->Definition ?>
                </div>
            </div>
        <?php
      }
    }
      ?>

      <div id="imageModal" class="modal modal-image">
        <span id="closeModal" class="close">&times;</span>
        <img class="modal-content">
      </div>

      </div>
    </div>
    <?= LinkPager::widget(['pagination' => $pages]); ?>
  </div>
</div>
