<?php
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
use yii\web\Application;
// Подключаем автозагрузчик Composer
require(__DIR__ . '/../vendor/autoload.php');
if (require(__DIR__ . '/../vendor/autoload.php')) {
    echo "Класс auto определен.";
} else {
    echo "Класс auto не определен.";
}
// Подключаем файл с настройками Yii2 приложения
$config = require(__DIR__ . '/../config/web.php');
if (require(__DIR__ . '/../config/web.php')) {
    echo "Класс conf определен.";
} else {
    echo "Класс conf не определен.";
}
// Создаем и запускаем экземпляр Yii2 приложения
try {
    (new Application($config))->run();
} catch (\yii\base\InvalidConfigException $e) {
}
//(new yii\web\Application($config))->run();