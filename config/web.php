<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$webhookDb = require __DIR__ . '/webhookDb.php';

$config = [
    'id' => 'ubbitt-360-v2',
    'name' => 'Ubbitt 360',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es-MX',
    'defaultRoute' => 'ubbitt-freemium/dashboard',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'xegemPqH4MG4ovxtFrH8QIrobKJS8N9g',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key' => '54cd1c0aae7b46c5f5284e5e5ecc478e',
            // You have to configure ValidationData informing all claims you want to validate the token.
            'jwtValidationData' => \app\components\JwtValidationData::class,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'loginUrl' => array('login/index'),
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            //'authTimeout' => 600, //seconds
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'ubbitt360.com',
                'username' => 'soporte@ubbitt360.com',
                'password' => '0POh8$(5Up,{',
                'port' => '465',
                'encryption' => 'ssl',
                'streamOptions' => [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false
                    ]
                ]
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/logs/app-' . date('Y') . '-' . date('m') . '-' . date('d') . '.log',
                ],
            ],
        ],
        'db' => $db,
        'webhookDb' => $webhookDb,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'UbbittSyntel',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET store-calls' => 'storeCalls',
                    ],
                ],
            ],
        ],
        'assetManager' => [
            'basePath' => '@webroot/yii-assets',
            'baseUrl' => '@web/yii-assets/',
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'css' => [],
                ],
                'yii\web\JqueryAsset' => [
                    'sourcePath' => '@webroot/assets/js/jquery',
                    'js' => [
                        'jquery-3.6.0.min.js',
                    ]
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;