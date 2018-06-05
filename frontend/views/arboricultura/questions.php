<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
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

      <?php foreach ($plants as $plant) {
        $items = [];
        foreach ($plant->photos as $photo) {
           $items[] = '<img class="img-responsive" src="../../'.Yii::$app->urlManagerBackend->baseUrl.'/'.$photo->Photo.'"/>';
        }
      ?>
        <div class="col-md-12 row row-plant">
           <div class="col-md-3">
             <?= Carousel::widget([
               'options' => ['class' => 'row-carousel'],
               'items' => $items,
             ]);?>
           </div>
           <div class="col-md-9">
             <h2 class="title"><?= $plant->Name ?></h2>
             <h2 class="title small-title">Nombre científico: <i><?= $plant->ScientificName ?></i></h2>
             <h2 class="title small-title">Familia botánica: <b><?= $plant->family->Name ?></b></h2>
             <br />
             <div class="row plant-char">
               <?php foreach ($plant->plantcharacteristics as $char) { ?>
                 <div class="col-md-3">
                   <?= $char->characteristic->Name ?> : <?= $char->Value ?>
                 </div>
               <?php } ?>
             </div>
              <br />
             <?= $plant->Description ?>
           </div>
        </div>
      <?php } ?>

    </div>
    <?= LinkPager::widget(['pagination' => $pages]); ?>
  </div>
</div>
