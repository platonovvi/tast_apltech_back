<?php
$originalDsn = getenv('DATABASE_URL');
// Парсим данные из DATABASE_URL
$dsnParts = parse_url($originalDsn);
// Удаление первого слэша перед именем базы данных
if (isset($dsnParts['path'])) {
    $dsnParts['path'] = ltrim($dsnParts['path'], '/');
}
$newDsn = "pgsql:host={$dsnParts['host']};port={$dsnParts['port']};dbname={$dsnParts['path']}";
$username = $dsnParts['user'] ?? '';
$password = $dsnParts['pass'] ?? '';

return [
    'class' => 'yii\db\Connection',
    'dsn' => $newDsn,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'on afterOpen' => function ($event) {
        Yii::info('Connected to the database!');
    },
];
