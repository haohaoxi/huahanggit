<?php

namespace merchant\assets;

use yii\web\AssetBundle;

/**
 * Main merchant application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/defualt';
    public $css = [
      //  'bootstrap-3.3.5-dist/css/bootstrap.min.css',
        'css/style.css',
        'css/dermadefault.css',
        'css/dermagreen.css',
        'css/dermaorange.css',
        'css/templatecss.css',
        'css/jquery-ui.css',
       // 'ui-layout-0.0.0/ui-layout.css',
    ];
    public $js = [
        'script/jquery-1.11.1.min.js',
        'script/jquery.cookie.js',
       // 'bootstrap-3.3.5-dist/js/bootstrap.min.js',
        'ui-layout-0.0.0/ui-layout.js',
        'script/angular.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
