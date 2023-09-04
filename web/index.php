<?php
// Определение корневой директории
defined('YII_ROOT') or define('YII_ROOT', dirname(__DIR__));
// Подключаем автозагрузчик Composer
require(__DIR__ . '/../vendor/autoload.php');
// Подключаем Yii2
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

// Подключение файла конфигурации
$config = require __DIR__ . '/../config/web.php';

// Определение порта, на котором будет работать встроенный сервер PHP
$port = getenv('PORT') ?: 8080;

// Запуск встроенного сервера PHP
$host = '0.0.0.0';
$server = new yii\web\Server($config);
$server->serve($host, $port);