<?php

$config = [
    'components' => [
        'user' =>[
           'identityClass'=>'common\models\User',
           'enableAutoLogin'=>true,
           'identityCookie'=>[
                    'name'=>'_frontendUser',
                ]
        ],
        'session'=>[
            'name'=>'PHPFRONTSESSID',
            'savePath'=>sys_get_temp_dir(),
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'SqEvKpnQFnLfAfiFUF5Wj_A1JdSVOmUS',
            'csrfParam' => '_frontendCSRF',
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
