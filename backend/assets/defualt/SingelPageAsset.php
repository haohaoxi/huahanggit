<?php

namespace backend\assets\defualt;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class SingelPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/defualt';
    public $css = [
		'AdminLTE/libs/font-awesome-4.7.0/css/font-awesome.min.css',
		'AdminLTE/libs/ionicons-2.0.1/css/ionicons.min.css',
		'AdminLTE/dist/css/AdminLTE.min.css',
		'AdminLTE/plugins/iCheck/square/blue.css',
		
    ];
    public $js = [
		'AdminLTE/plugins/iCheck/icheck.min.js',	
    ];
    public $depends = [
        'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset', //加载css
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
