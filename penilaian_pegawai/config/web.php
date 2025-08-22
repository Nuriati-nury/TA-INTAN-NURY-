<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',    
    'timeZone' => 'Asia/Seoul',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    // 'homeUrl' => ['site/index'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
    'user' => [
        'identityClass' => 'app\models\User',
        'enableAutoLogin' => false, // matikan auto login
        'authTimeout' => 900, // tetap bisa pakai timeout 15 menit
    ],
    'session' => [
        'class' => 'yii\web\Session',
        'timeout' => 900, // 15 menit idle timeout
        'cookieParams' => [
            'lifetime' => 0, // cookie hilang saat browser ditutup
        ],
    ],


        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'tan',
        ],
        //  'urlManager' => [
        //     'enablePrettyUrl' => true,
        //     'showScriptName' => false,
        //     'rules' => [
        //         'rekapitulasi-penilaian' => 'penilaian/rekapitulasi',
        //            'pegawai-terbaik' => 'penilaian/pegawai-terbaik',
        //     ],
        // ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
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
