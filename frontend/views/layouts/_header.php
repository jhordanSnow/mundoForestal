<?php
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\helpers\Html;

use backend\models\Pagedata;
?>
<div class="navbar navbar-logo">
  <div class="w3-agile-logo">
    <div class="row">
      <div class="col-md-2 logo-container">
        <a href="<?=Url::toRoute('/site/index')?>">
          <img src="<?= Yii::$app->request->baseUrl . '/images/logo_thin.png' ?>" class=" img-responsive logo-thin" >
        </a>
      </div>
      <div class="col-md-10">
        <?php

        $content = Pagedata::find()->all();
        $links = [];
        if (count($content) > 0){
          $items = [];
          foreach ($content as $page) {
            $items[] = ['label' => $page->Title, 'url' => ['/arboricultura/content', 'id' => $page->IdData]];
          }
          $links = ['label' => 'Arboricultura', 'items' => $items,];
        }

        $menuItems = [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            $links,
            ['label' => 'Plantas', 'url' => ['/arboricultura/search-plant']],
            ['label' => 'Terminología', 'url' => ['/arboricultura/terminologia']],
            ['label' => 'Consultorio forestal', 'url' => ['/arboricultura/questions']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = ['label' => 'Contacto', 'url' => ['/site/contact']];
            $menuItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => '#','options'=>['id'=>'a-logout']];
            $menuItems[] = '<li class="hidden">'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton('',['class' => 'btn btn-link logout', 'id' => 'btn-logout'])
                . Html::endForm()
                . '</li>';
        }

        ?>
        <nav class="navbar navbar-default custom-navbar">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <?php
        echo Nav::widget([
            'options' => ['class' => 'navbar navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        ?>
        </div>
      </nav>
      </div>
    </div>
  </div>
</div>
