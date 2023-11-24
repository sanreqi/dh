<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=47.102.141.111;dbname=dh',
            'username' => 'srq',
            'password' => 'linquistics26',
            'charset' => 'utf8',
        ],
//        'db' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=localhost;dbname=dh',
//            'username' => 'root',
//            'password' => 'root',
//            'charset' => 'utf8',
//        ],
//        'db' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=172.16.25.52;dbname=test2',
//            'username' => 'paidan_user',
//            'password' => 'aaA5y6C9vL',
//            'charset' => 'utf8',
//        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],

        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
    ],
];
//test

//test2

//test3