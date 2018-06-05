<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

$fullName =Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->lastname;
?>

<header class="main-header">

  <a class="logo logo-header" href="<?= Yii::$app->homeUrl ?>" >
    <img src="<?= Url::base() ?>/Images/logo-min-reverse.png" class="img-responsive logo-mini" />
    <img src="<?= Url::base() ?>/Images/logo-reverse.png" class="img-responsive logo-lg" />
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                  <?= Html::a($fullName, ['/user/profile']) ?>
              </li>
              <li>
                <?= Html::a('Sign out', ['/site/logout'],['data-method' => 'post']) ?>
              </li>
          </ul>
      </div>
  </nav>
</header>
