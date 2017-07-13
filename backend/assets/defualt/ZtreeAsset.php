<?php

namespace backend\assets\defualt;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class UeditorAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/defualt';
    public $css = ['zTree/css/zTreeStyle/zTreeStyle.css'];
    public $js = [
        'zTree/js/jquery.ztree.core.js',
    ];
    public $depends = [
       'backend\assets\defualt\AppAsset'
    ];

}
