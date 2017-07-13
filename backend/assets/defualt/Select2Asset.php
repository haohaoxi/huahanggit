<?php

namespace backend\assets\defualt;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class Select2Asset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/defualt';
    public $css = [
        'AdminLTE/plugins/select2/select2.min.css',
    ];
    public $js = [
         'AdminLTE/plugins/select2/select2.full.min.js',
    ];
    public $depends = [
       // 'yii\web\YiiAsset',
       'backend\assets\defualt\AppAsset'
    ];

}
