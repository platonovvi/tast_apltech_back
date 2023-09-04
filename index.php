<?php

// Определите путь к файлу autoload.php
$autoloadPath = __DIR__ . '/app/vendor/autoload.php';

// Проверьте, существует ли autoload.php
if (!file_exists($autoloadPath)) {
    die("Ошибка: Файл 'autoload.php' не найден. Убедитесь, что зависимости Composer установлены и верно настроены.");
}

// Подключите автозагрузчик
require_once $autoloadPath;

// Определите путь к файлу web/index.php
$yiiPath = __DIR__ . '/app/web/index.php';

// Проверьте, существует ли index.php
if (!file_exists($yiiPath)) {
    die("Ошибка: Файл 'index.php' не найден в директории 'web'. Убедитесь, что структура проекта настроена правильно.");
}

// Подключите файл index.php
require_once $yiiPath;