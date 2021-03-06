<?php

$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__ . '/db_local.php')?require __DIR__ . '/db_local.php':require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'language' => 'ru_RU',
    'aliases' => [
	    '@bower' => '@vendor/bower-asset',
	    '@npm'   => '@vendor/npm-asset',
	    '@files' => '/var/www/files/',
	    '@filesWeb'=>'/files/',
    ],
    'components' => [
	    'rbac'=>['class'=>\app\components\RbacComponent::class],
    	'authManager' => [
    		'class' => 'yii\rbac\DbManager'
	    ],
	    'activity'=>['class'=>\app\components\ActivityComponent::class],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'lxcyR239BhdfkIOsdrf9467sDFgf',
            'baseUrl'=> ''
        ],
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
	            [
		            'host' => 'localhost',
		            'port' => 11211
	            ],
            ],
            'useMemcached' => true
        ],
	    'dao'=>['class'=>\app\components\DAOComponent::class],
	    'auth'=>['class'=>\app\components\AuthComponent::class],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true
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
			    // Your rules here
		    ],
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
        'allowedIPs' => ['127.0.0.1', '::1', '5.19.192.121'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '5.19.192.121'],
    ];
}

return $config;
