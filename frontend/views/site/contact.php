<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use kartik\widgets\Select2;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container container-text">
  <div class="site-contact">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
      <div class="alert alert-success alert-dismissable">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i>Saved!</h4>
      <?= Yii::$app->session->getFlash('success') ?>
      </div>
    <?php endif; ?>

    <div class="row">
      <div class="col-md-12" style="text-align: center;">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>
      </div>
      <div class="contact-two-grids">
        <div class="col-md-12 contact-left-grid">
          <div class=" col-md-4 col-sm-5 contact-icons">
            <div class=" footer_grid_left">
              <div class="icon_grid_left">
                <span class="fa fa-map-marker" aria-hidden="true"></span>
              </div>
              <h5>Dirección</h5>
              <p>La Uruca,<span>San José, Costa Rica</span></p>
            </div>
            <div class=" footer_grid_left">

              <div class="icon_grid_left">
                <span class="fa fa-volume-control-phone" aria-hidden="true"></span>
              </div>
              <h5>Teléfono</h5>
              <p>+(506) 2296-5638</p>
            </div>
            <div class=" footer_grid_left">
              <div class="icon_grid_left">

                <span class="fa fa-envelope" aria-hidden="true"></span>
              </div>
              <h5>Correo <br />Electrónico</h5>
              <p><a href="mailto:mundoforestal@elmundoforestal.com">mundoforestal@elmundoforestal.com</a></p>
            </div>

          </div>
          <div class="col-md-8 contact-us">
            <div class="question-form">

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'IdCategory')->widget(Select2::classname(), [
                      'data' => $categoryList,
                      'options' => ['placeholder' => 'Seleccione una categoría'],
                    ]); ?>
                <?= $form->field($model, 'Question')->textarea(['rows' => 10]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
          </div>
        </div>
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
