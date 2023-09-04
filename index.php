<?php
// index.php в корне

// Определяем базовую директорию вашего приложения
define('BASE_DIR', __DIR__);

// Перенаправляем запрос к web/index.php
require(BASE_DIR . '/web/index.php');