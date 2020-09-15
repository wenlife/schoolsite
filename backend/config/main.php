<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'name'=>'七中内网',
    'bootstrap' => ['log'],
    'language' =>'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'defaultRoute' => 'tcenter',
    'modules' => [
       // 'content' => [
       //      'class' => 'backend\modules\content\Module',
       //  ],
        // 'test' => [
        //     'class' => 'backend\modules\test\Module',
        // ],
        'guest' => [
            'class' => 'backend\modules\guest\Module',
        ],
        'testService' => [
            'class' => 'backend\modules\testService\Module',
        ],
        'school' => [
            'class' => 'backend\modules\school\Module',
        ],
        'sys' => [
            'class' => 'backend\modules\sys\Module',
        ],
        'sign' => [
            'class' => 'backend\modules\sign\Module',
        ],
        // 'guidance' => [

        //     'class' => 'backend\modules\guidance\Module',
        // ],

    ],
    'components' => [
        'user' =>[
           'identityClass'=>'common\models\Adminuser',
           'enableAutoLogin'=>true,
           'identityCookie'=>[
                    'name'=>'_backendUser',
                ]
        ],
        'session'=>[
            'name'=>'PHPBACKSESSID',
            'savePath'=>sys_get_temp_dir(),
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'TaMa1ELJgYLdQy-9wU0zv8EwRICrl3IR',
                'csrfParam' => '_backendCSRF',

            'trustedHosts' => [
            '192.168.3.0/24',
            ],
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
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
