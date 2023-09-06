<?php
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
use yii\web\Application;
// Подключаем автозагрузчик Composer
require(__DIR__ . '/../vendor/autoload.php');
// Подключаем файл с настройками Yii2 приложения
$config = require(__DIR__ . '/../config/web.php');
// Создаем и запускаем экземпляр Yii2 приложения
try {
    (new Application($config))->run();
} catch (\yii\base\InvalidConfigException $e) {
}