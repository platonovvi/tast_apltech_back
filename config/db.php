<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=ec2-107-21-67-46.compute-1.amazonaws.com;port=5432;dbname=db0asres84leif',
    'username' => 'aoverokslpmuih',
    'password' => '82998c11d8c760242578d4ded65fc5c6e46fc9111ade524a47b9e60b4357fa2f',
    'charset' => 'utf8',
    // Дополнительные настройки, если необходимо
    'on afterOpen' => function ($event) {
        // Вы можете добавить дополнительные действия после установки соединения
    },
    'schemaMap' => [
        'pgsql' => [
            'class' => 'yii\db\pgsql\Schema',
            'defaultSchema' => 'public', // Если ваша схема отличается от "public"
        ],
    ],
];
