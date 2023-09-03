<?php
Yii::error('Местоположение ошибки: какая-то информация о состоянии приложения', 'имя_категории_лога');
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');
$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'your-random-key-here',
        ],
        'response' => [
            'format' => 'json',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
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
            /*'on afterOpen' => function ($event) {
                Yii::info('Connected to the database!');
            },*/
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
                    'levels' => ['error', 'warning'],
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

if (YII_ENV) {
    // Конфигурация для разработки
} else {
    // Конфигурация для продакшена
}

return $config;