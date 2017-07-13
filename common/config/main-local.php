<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=116.62.200.83;dbname=yii2webdb',
            'username' => 'yii2webuser',
            'password' => 'yii2webuserPWadmin123',
            'charset' => 'utf8',
            'tablePrefix' => 'hhqy_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.126.com', //每种邮箱的host配置不一样
                'username' => 'webherobo@126.com',
                'password' => 'admin123',
                'port' => '25',
                'encryption' => 'tls',
            ],
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['webherobo@126.com' => 'admin']
            ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
           // 'useFileTransport' => true,
            'useFileTransport' => false,
        ],
    ],
];
