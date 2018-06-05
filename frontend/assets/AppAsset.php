<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $publishOptions = [
      'forceCopy'=>true,
    ];
    public $sourcePath = '@webroot/themes/forestal/';
    public $css = [
        'css/site.css',
        'css/bootstrap.css',
        'css/font-awesome.css',
        'css/style.css',
        'css/lightbox.css',
    ];
    public $js = [
        'js/site.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
