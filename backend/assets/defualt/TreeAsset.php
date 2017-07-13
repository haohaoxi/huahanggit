<?php

namespace backend\assets\defualt;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class TreeAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/defualt';
    public $css = [
        'treeview/src/css/bootstrap-treeview.css',
    ];
    public $js = [
        'treeview/src/js/bootstrap-treeview.js',
    ];
    public $depends = [
       'backend\assets\defualt\AppAsset'
    ];

}
