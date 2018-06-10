<?php

use yii\helpers\Url;

$this->title = 'Mundo Forestal';
?>
<div class="header-outs">
  <!-- Slideshow 4 -->
  <div class="slider">
    <div class="callbacks_container">
      <ul class="rslides" id="slider4">
        <li>
          <div class="slider-img">
            <div class="container">
              <div class="slider-info">
                <h4>
                  <i>No podemos cuidar algo si no lo conocemos</i>
                </h4>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>


<div class="services" id="services">
  <div class="container">
    <h1 style="text-align: center;">Árboles de Costa Rica y Educación Forestal</h1>
    <div class="block-padding row">
      <?php foreach ($treeTypes as $tree) { ?>
        <div class="col-sm-4">
          <a href="<?=Url::toRoute(['/arboricultura/search-plant', 'IdType' => $tree->IdType])?>">
          <div class="white-shadow">
              <h2 class="title" style="text-align: center;"><?= $tree['Name'] ?></h2>
              <br />
              <?php
              try{
                echo '<img class="image-type img-responsive" src="../../'.Yii::$app->urlManagerBackend->baseUrl.'/'.$tree->plants[0]->photos[0]->Photo.'"/>';
              }catch(Exception $e){
                echo '<img class="img-responsive" src="../../'.Yii::$app->urlManagerBackend->baseUrl.'/noImage.png"/>';
              }
              ?>
            </div>
        </div>
      </a>
      <?php } ?>
      <div class="clearfix"> </div>
    </div>
  </div>
</div>
