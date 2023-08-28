<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => getenv('DATABASE_URL'),
    'charset' => 'utf8',
    // Дополнительные настройки, если необходимо
    'on afterOpen' => function ($event) {
        // Вы можете добавить дополнительные действия после установки соединения
        Yii::info('Database connection successful.', 'application');
    },
    'schemaMap' => [
        'pgsql' => [
            'class' => 'yii\db\pgsql\Schema',
            'defaultSchema' => 'public', // Если ваша схема отличается от "public"
        ],
    ],
];
