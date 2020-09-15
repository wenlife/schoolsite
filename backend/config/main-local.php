<?php

$config = [
    'components' => [
    	'mailer' => [  
           'class' => 'yii\swiftmailer\Mailer',  
           'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
           'transport' => [  
               'class' => 'Swift_SmtpTransport',  
               'host' => 'smtp.163.com',  //每种邮箱的host配置不一样
               'username' => 'mawl126@163.com',  
               'password' => 'PBIBRGIQPROAALWM',  
              //'password' => 'malin1022',
               'port' => '25',  
               'encryption' => 'tls',  
                                   
                           ],   
           'messageConfig'=>[  
               'charset'=>'UTF-8',  
               'from'=>['mawl126@163.com'=>'admin']  
         ],  
        ], 
        // 'user' =>[
        //    'identityClass'=>'common\models\Adminuser',
        //    'enableAutoLogin'=>true,
        //    'identityCookie'=>[
        //             'name'=>'_backendUser',
        //         ]
        // ],
        // 'session'=>[
        //     'name'=>'PHPBACKSESSID',
        //     'savePath'=>sys_get_temp_dir(),
        // ],
        // 'request' => [
        //     // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        //     'cookieValidationKey' => 'TaMa1ELJgYLdQy-9wU0zv8EwRICrl3IR',
        //         'csrfParam' => '_backendCSRF',
        // ],
        //'password' => 'PBIBRGIQPROAALWM',
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
