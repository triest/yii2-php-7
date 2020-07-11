<?php

    $params = require __DIR__ . '/params.php';
    $db = require __DIR__ . '/db.php';

    $config = [
            'id' => 'basic',
            'basePath' => dirname(__DIR__),
            'bootstrap' => ['log'],
            'aliases' => [
                    '@bower' => '@vendor/bower-asset',
                    '@npm' => '@vendor/npm-asset',
            ],
            'components' => [
                    'request' => [
                        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                            'cookieValidationKey' => 'N4QLfkq5SlCOZmhKw8qlT42ZnbE-xIJT',
                    ],
                    'cache' => [
                            'class' => 'yii\caching\FileCache',
                    ],
                    'user' => [
                            'identityClass' => 'app\models\User',
                            'enableAutoLogin' => true,
                    ],
                    'errorHandler' => [
                            'errorAction' => 'site/error',
                    ],
                    'mailer' => [
                            'class' => 'yii\swiftmailer\Mailer',
                        // send all mails to a file by default. You have to set
                        // 'useFileTransport' to false and configure a transport
                        // for the mailer to send real emails.
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

                    'urlManager' => [
                            'enablePrettyUrl' => true,
                            'showScriptName' => false,
                            'rules' => [
                                    '<module:(admin)>/<type:>' => '<module>/<type>/index',
                                    '<module:(admin)>/<type:>/<action:>' => '<module>/<type>/<action>',
                                    '<action:(login|logout)>' => 'site/<action>',
                                    '<module:(article)>' => '<module>/default/index',
                                    '<module:(article)>/<id:\d+>' => '<module>/default/view',
                                    '<module:(article)>/edit/<id:\d+>' => '<module>/default/edit',
                                    'GET <module:(article|)>/create' => '<module>/default/create',
                                    'POST <module:(article|)>/create' => '<module>/default/create',
                                    '<module:(article)>/delete/<id:\d+>' => '<module>/default/delete',

                                    'PUT,PATCH <module:(rest)>/<id:\d+>' => '<module>/default/update',
                                    'DELETE <module:(rest)>/<id:\d+>' => '<module>/default/delete',
                                    'POST <module:(rest)>' => '<module>/default/create',
                                    'GET <module:(rest)>/<id:\d+>' => '<module>/default/view',
                                    'GET,HEAD <module:(rest)>' => 'modules/rest/index',
                                    'rest' => 'modules/rest/options',

                            ],
                    ],

            ],
            'modules' => [
                    'admin' => [
                            'class' => 'app\modules\admin\Admin',
                    ],
                    'article' => [
                            'class' => 'app\modules\article\Article',
                    ],
                    'rest' => [
                            'class' => 'app\modules\rest\Rest',
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
