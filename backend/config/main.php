<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'baseUrl' => '/admin', // данный адрес соответсвует с тем адресом который мы задали в .htaccess из общего рута нашего приложения.
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => '45ed697423АВЫ"№g9eheg00j09',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w\-]+>' => '<_c>/index',
                '<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_c>/<_a>',
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
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['admin'],

            'roots' => [
//                'baseUrl'=>'@web',
//                'basePath'=>'@webroot',
//                'path' => 'web',
//                'name' => 'Files'
                [
                    'basePath'=>'@frontend/web/img',
                    'path' => 'uploads',
                    'name' => 'Files',
                    'options' => [
                        'uploadOverwrite' => false,
                        'uploadAllow' => array('image'),
                        'uploadOrder' => array('allow', 'deny'),
                        'uploadDeny'   => array(),
                        'uploadMaxSize' => '2000K',
//                        'disabled' => array('rename', 'mkfile'),
                    ],
                ],
            ],
            'watermark' => [
//                'source'         => __DIR__.'/logo.png', // Path to Water mark image
//                'marginRight'    => 5,          // Margin right pixel
//                'marginBottom'   => 5,          // Margin bottom pixel
//                'quality'        => 95,         // JPEG image save quality
//                'transparency'   => 70,         // Water mark image transparency ( other than PNG )
//                'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
//                'targetMinPixel' => 200         // Target image minimum pixel size
            ]
        ]
    ],
];
