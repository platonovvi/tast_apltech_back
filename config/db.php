<?php
$originalDsn = getenv('DATABASE_URL');
$dsnParts = parse_url($originalDsn);

// Создаем новую строку DSN в правильном формате
$newDsn = "pgsql:host={$dsnParts['host']};port={$dsnParts['port']};dbname={$dsnParts['path']}";
return [
    'class' => 'yii\db\Connection',
    'dsn' => $newDsn,
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'on afterOpen' => function ($event) {
        Yii::info('Connected to the database!');
    },
];
