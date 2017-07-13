<?php

namespace backend\assets\defualt;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/defualt';
    public $css = [
        'AdminLTE/bootstrap/css/bootstrap.min.css',
        'AdminLTE/libs/font-awesome-4.7.0/css/font-awesome.min.css',
        'AdminLTE/libs/ionicons-2.0.1/css/ionicons.min.css',
        'AdminLTE/dist/css/skins/_all-skins.min.css',
        'AdminLTE/dist/css/AdminLTE.min.css',
        'AdminLTE/plugins/iCheck/flat/blue.css',
        'AdminLTE/plugins/morris/morris.css',
        'AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
        'AdminLTE/plugins/datepicker/datepicker3.css',
        'AdminLTE/plugins/daterangepicker/daterangepicker.css',
        'AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'AdminLTE/plugins/iCheck/square/blue.css',
        'css/site.css',
    ];
    public $js = [
        //'AdminLTE//plugins/jQuery/jquery-2.2.3.min.js',
        'AdminLTE/bootstrap/js/bootstrap.min.js',
        'AdminLTE/plugins/jQueryUI/jquery-ui.min.js',
        'AdminLTE/libs/raphael/raphael-min.js',
        'AdminLTE/plugins/morris/morris.min.js',
        'AdminLTE/plugins/sparkline/jquery.sparkline.min.js',
        'AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'AdminLTE/plugins/knob/jquery.knob.js',
        'AdminLTE/libs/moment.js/moment.min.js',
        'AdminLTE/plugins/daterangepicker/daterangepicker.js',
        'AdminLTE/plugins/datepicker/bootstrap-datepicker.js',
        'AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js',
        'AdminLTE/plugins/fastclick/fastclick.js',
        'AdminLTE/dist/js/app.min.js',
        //'AdminLTE/dist/js/pages/dashboard.js',
        'AdminLTE/plugins/iCheck/icheck.min.js',
        'AdminLTE/dist/js/demo.js',
        'template/template.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
            //'yii\bootstrap\BootstrapAsset', //加载css
    ];

    //定义按需加载JS方法，注意加载顺序在最后  
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\defualt\AppAsset']);
    }

    //定义按需加载css方法，注意加载顺序在最后  
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\defualt\AppAsset']);
    }

    //AppAsset::addScript($this,'@web/js/jquery-ui.custom.min.js');  模板使用方法
}
