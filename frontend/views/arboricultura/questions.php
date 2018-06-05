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
        <?= Html::label('Categorías', 'IdCategory') ?>
        <ul class="nav nav-tabs nav-stacked side-nav">
          <li></li>
          <?php
          foreach ($categoryList as $id => $category) {
            $class = (Yii::$app->getRequest()->getQueryParam('IdCategory') == $id) ? 'actual' : '';
            ?>
            <li class="<?=$class?>"><a href="<?= Url::to(['/arboricultura/questions']); ?>&IdCategory=<?=$id?>">
              <?= $category ?>
            </a></li>
          <?php } ?>
        </ul>
      </div>
      <div class="col-md-9 row">

        <?php
        if (count($questions) == 0){ ?>
          <div class="no-record">;
            <h1 class="title">No se encontraron resultados. </h1><br />
            <img class="img-responsive" src="../../<?=Yii::$app->urlManagerBackend->baseUrl?>/noRecord.png"/>
          </div>
        <?php }else{
          foreach ($questions as $question) {
          ?>
            <div class="col-md-12">
                <h2 class="title"><?= $question->Question ?></h2>
                <?= $question->user->username ?>
            </div>
        <?php
      }
    }
      ?>

      </div>
    </div>
    <?= LinkPager::widget(['pagination' => $pages]); ?>
  </div>
</div>
