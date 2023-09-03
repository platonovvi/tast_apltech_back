<?php

return [
    'class' => 'yii\db\Connection',
    //'dsn' => getenv('DATABASE_URL'),
    'dsn' => 'pgsql:host=ec2-35-169-11-108.compute-1.amazonaws.com;port=5432;dbname=d80k1v9v2tj9r3',
    'username' => 'kkvlrykuzvfqzw',
    'password' => 'e3513f86ae7e498602e2dd5beb526b6ec2d71892cacbd2335a051e497f505267',
    'charset' => 'utf8',
    'on afterOpen' => function ($event) {
        //Yii::info('Database connection successful.', 'application');
    },
    'enableSchemaCache' => true,
];
