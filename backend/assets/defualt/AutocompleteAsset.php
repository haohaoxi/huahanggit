<?php

namespace backend\assets\defualt;

use yii\web\AssetBundle;

/**
 * AutocompleteAsset
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class AutocompleteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/defualt';
    /**
     * @inheritdoc
     */
    public $css = [
       
    ];
    /**
     * @inheritdoc
     */
    public $js = [
       
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
