<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'post/index',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => '',
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => '45ed697dtg8uhrg9eheg00j09',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:(category|comment|post|tag|site)>/<id:\d+>' => '<controller>/view',
                '<controller:(category|comment|post|tag|site)>' => '<controller>/index',
                '<controller:(category|comment|post|tag|site)>/<action:[\w\-]+>' => '<controller>/<action>',
                '<controller:(category|comment|post|tag|site)>/<action:[\w\-]+>/<id:\d+>' => '<controller>/<action>',
                '<page_url:[\w\-]+>' => 'page/index',
                '<page_url:[\w\-]+>/<model_url:[\w\-]+>' => 'page/index',
                '<page_url:[\w\-]+>/<model_url:[\w\-]+>/<model_child:[\w\-]+>' => 'page/index',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
