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
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute'=>'site/index',
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\User',
        ],

        'touch' => [
            'class' => 'frontend\modules\touch\Touch',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
	'urlManager' => [

        	'enablePrettyUrl' => true,
        	'showScriptName' => false,
        	'rules' => [
            		'login' => '/site/login',
                    'signup' => '/site/signup',
			        'contact'=>'/site/contact',
			        '/'=>'/site/index',
            		'about' => '/site/about',
            		'm_about' => '/touch/default/about',
            		'm_contact' => '/touch/default/contact',
            		'm_home' => '/touch/default',
       		 ]
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
