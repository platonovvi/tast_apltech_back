<?php
// Подключаем автозагрузчик Composer
require(__DIR__ . '/vendor/autoload.php');
//require(__DIR__ . '\vendor\autoload.php');

// Подключаем файл с настройками Yii2 приложения
$config = require (__DIR__ . '/config/web.php');
//$config = require __DIR__ . '\config\web.php';

// Создаем и запускаем экземпляр Yii2 приложения
(new yii\web\Application($config))->run();