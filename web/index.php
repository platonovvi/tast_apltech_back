<?php

// Подключаем автозагрузчик Composer
require(__DIR__ . '/../vendor/autoload.php');
// Подключаем Yii2
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

// Определение окружения (Development, Production и т.д.)
/*defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV') ?: 'prod');*/
// Подключение файла конфигурации
$config = require(__DIR__ . '/../config/web.php');
// Запуск приложения Yii2
if (PHP_SAPI === 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
} else {
    (new yii\web\Application($config))->run();
}