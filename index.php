<?php

// Подключаем автозагрузчик Composer
require(__DIR__ . '/vendor/autoload.php');
//require(__DIR__ . '\vendor\autoload.php');

// Подключаем файл с настройками Yii2 приложения
$config = require __DIR__ . '/config/web.php';
//$config = require __DIR__ . '\config\web.php';
// Определяем, используется ли встроенный PHP-сервер
if (PHP_SAPI === 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    // Если запрошенный файл существует, возвращаем его
    if (is_file($file)) {
        return false;
    }
}
// Создаем и запускаем экземпляр Yii2 приложения
(new yii\web\Application($config))->run();