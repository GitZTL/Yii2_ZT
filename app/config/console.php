<?php

$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__.'/db_local.php')
    ?(require __DIR__ . '/db_local.php')
    :(require __DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [

        'authManager'=>[

            'class'=>'yii\rbac\DbManager'
        ],

        'formatter'=>[
            'class'=>'\yii\i18n\Formatter',
            'dateFormat'=>'php:d.m.Y',
            'dateTimeFormat'=>'php:d.m.Y H:i'
        ],

        'activity'=>[
            'class'=>\app\components\ActivityComponent::class,
            'activity_class'=>'app\models\Activity'
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' =>false,
            'enableSwiftMailerLogging'=>true,
            'transport'=>[
                'class'=>'Swift_SmtpTransport',
                'host'=>'smtp.yandex.ru',//указать smtp server
                'username'=>'ivankot@yandex.ru',
                'password'=>'pass here', //добавить пароль
                'port'=>'587', //защищенное подключение
                'encryption'=>'tls'

            ]
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,  //true - значит будет сохранять письмо в файл
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
