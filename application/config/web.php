<?php
/**
 * Конфигурационной файл приложения
 */

$config = [
    'core' => [ // подмассив используемый самим ядром фреймворка
        'db' => [
            'dns' => 'mysql:host=localhost;dbname=dbname',
            'username' => 'root',
            'password' => '1234'
        ],
        'router' => [
            
        ],
        'url' => [ 
            'class' => \ItForFree\SimpleMVC\Url::class
        ],
        'mvc' => [
            'views' => [
                'base-template-path' => '../application/views/',
                'footer-path' => '',
                'header-path' => ''
            ]
        ],
        'user' => [
            'class' => \ItForFree\SimpleMVC\User::class
        ]
    ]    
];


return $config;