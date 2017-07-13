<?php

namespace backend\assets\defualt;

use yii\web\AssetBundle;

/**
 * Description of AnimateAsset
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 2.5
 */
class AnimateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/defualt';
    /**
     * @inheritdoc
     */
    public $css = [
        'assets/animate.css',
    ];

}
