<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$domain = $_SERVER['HTTP_HOST'];
$port = $_SERVER['SERVER_PORT'];

$baseUrl = $protocol . '://' . $domain;
if (($protocol === 'http' && $port != 80) || ($protocol === 'https' && $port != 443)) {
    $baseUrl .= ':' . $port;
}

error_log('Root URL: ' . $baseUrl); // Запись в лог

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();

