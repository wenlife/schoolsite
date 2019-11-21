<?php

$config = [
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
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
