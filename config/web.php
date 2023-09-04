<?php
/*defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');*/
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'security' => [
            'class' => 'yii\base\Security',
        ],
        'request' => [
            'class' => 'yii\web\Request',
            'cookieValidationKey' => 'aBcDeFgH1234567890IjKlMnOpQrStUvWxYz',
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'format' => 'json',
        ],
        /*'cache' => [
            'class' => 'yii\caching\FileCache',
        ],*/
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'user/get_users' => 'user/get-users',
                '/' => 'site/index',
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => getenv('DATABASE_URL'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'on afterOpen' => function ($event) {
                Yii::info('Connected to the database!');
            },
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                // ...
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => false, // Отключаем стандартный JqueryAsset
                'yii\bootstrap5\BootstrapAsset' => false, // Отключаем стандартный BootstrapAsset
            ],
        ],
    ],
    'aliases' => [
        '@bower/bootstrap' => '@vendor/bower-asset/bootstrap',
    ],
    'params' => $params,
];

return $config;