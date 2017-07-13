<?php

$config = [
    'language' => 'zh-CN',
    'components' => [

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/config/messages',
                    //'language' => 'zh-CN',
                    'sourceLanguage' =>  'en-US',
					//'fileMap' => [
                   // 'user' => 'user.php',
                   // 'noty' => 'noty.php',
					//'yii2mod.rbac' => 'yii2mod.rbac.php',
                //],
                ],
            ],
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/config/messages',
                ],
		        'user' => [
		            'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/config/messages',
		        ],
                'noty' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/config/messages',
                ], 
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/config/messages',
                ],
		    ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ZltljT1_kNqNbxS3GowqCJ4KivW3kR53',
        ],
        'view' => [
            'theme' => [
               // 'basePath' => '@backend/views/themes/defualt',
                'pathMap' => ['@backend/views' => '@backend/views/themes/defualt',
                    '@app/modules' => '@backend/views/themes/defualt/modules',
                    '@app/widgets' => '@backend/views/themes/defualt/widgets'],
               // 'baseUrl' => '@web/themes/defualt',
            ],
        ],
    ],
 "aliases" => [
        "@kartik/file" => "@vendor/kartik-v/yii2-widget-fileinput",
		"@kartik" => "@vendor/kartik-v",
		"@kartik/base" => "@vendor/kartik-v/yii2-krajee-base",
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '192.168.111.129', '*', '::1']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '192.168.111.129', '*', '::1']
    ];
}

return $config;
