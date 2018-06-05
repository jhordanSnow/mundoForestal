<?php
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="navbar navbar-logo">
  <div class="w3-agile-logo">
    <div class="row">
      <div class="col-md-3 logo-container">
        <a href="<?=Url::toRoute('/site/index')?>">
          <img src="<?= Yii::$app->request->baseUrl . '/images/logo_thin.png' ?>" class=" img-responsive logo-thin" >
        </a>
      </div>
      <div class="col-md-9">
        <?php
        $menuItems = [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Quienes somos', 'url' => ['/site/about']],
            ['label' => 'Arboricultura', 'items' => [
                    ['label' => 'Arboricultor', 'url' => ['/arboricultura/arboricultor']],
                    ['label' => 'Cazadores de carbono', 'url' => ['/arboricultura/cazadores-de-carbono']],
                    ['label' => 'La chaya', 'url' => ['/arboricultura/la-chaya']],
                    ['label' => 'Filatelia', 'url' => ['/arboricultura/filatelia']],
                    ['label' => 'Pitahaya', 'url' => ['/arboricultura/pitahaya']],
                    ['label' => 'Terminología', 'url' => ['/arboricultura/terminologia']],
                    ['label' => 'Links', 'url' => ['/arboricultura/links']],
                ],
            ],
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
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        ?>
      </div>
    </div>
  </div>
</div>
