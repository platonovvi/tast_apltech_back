<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => getenv('DATABASE_URL'), // Получаем DSN из переменной окружения DATABASE_URL
    'username' => getenv('DB_USERNAME'), // Получаем имя пользователя из переменной окружения DB_USERNAME
    'password' => getenv('DB_PASSWORD'), // Получаем пароль из переменной окружения DB_PASSWORD
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'on afterOpen' => function ($event) {
        Yii::info('Connected to the database!');
    },
];
