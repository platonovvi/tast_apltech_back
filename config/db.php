<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => getenv('DATABASE_URL'),
    'charset' => 'utf8',
    'on afterOpen' => function ($event) {
        Yii::info('Database connection successful.', 'application');
    },
    'enableSchemaCache' => true,
];
