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
    'modules' => [
       'content' => [
            'class' => 'backend\modules\content\Module',
        ],
        'test' => [
            'class' => 'backend\modules\test\Module',
        ],
        'guest' => [
            'class' => 'backend\modules\guest\Module',
        ],
        'testService' => [
            'class' => 'backend\modules\testService\Module',
        ],
        'school' => [
            'class' => 'backend\modules\school\Module',
        ],
        'guidance' => [

            'class' => 'backend\modules\guidance\Module',
        ],

    ],
    'components' => [
        // 'request' => [
        //     'csrfParam' => '_csrf-backend',
        // ],
        // 'user' => [
        //     'identityClass' => 'common\models\User',
        //     'enableAutoLogin' => true,
        //     'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        // ],
        // 'session' => [
        //     // this is the name of the session cookie used for login on the backend
        //     'name' => 'advanced-backend',
        // ],
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
