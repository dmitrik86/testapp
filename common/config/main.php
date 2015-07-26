<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'suffix' => '/',
            'rules' => [
/*
                [
                    'pattern' => 'users/<action>/<slug>',
                    'route' => 'users/<action>',
//                    'defaults' => ['slug' => ''],
                ],
//                'users/<action>/<id:\d+>' => 'users/<action>',
                'users/<action>' => 'users/<action>',
*/
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                '<controller>/<action>' => '<controller>/<action>',
//                'users' => 'users/index',
                'login' => 'site/login',
                'logout' => 'site/logout',
                'signup' => 'site/signup',
                'about' => 'site/about',
                'contact' => 'site/contact',
                '/' => 'site/index',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
//            'defaultRoles' => ['guest'],
        ],
    ],
];
