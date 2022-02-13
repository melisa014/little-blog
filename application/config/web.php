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
        'router' => [ // подсистема маршрутизация
            'class' => \ItForFree\SimpleMVC\Router::class    
        ],
        'url' => [ 
            'class' => \ItForFree\SimpleMVC\Url::class
        ],
        'mvc' => [ // настройки MVC
            'views' => [
                'base-template-path' => '../application/views/',
                'base-layouts-path' => '../application/views/layouts/',
                'footer-path' => '',
                'header-path' => ''
            ]
        ],
        'handlers' => [ // подсистема перехвата исключений
            'ItForFree\SimpleMVC\exceptions\SmvcAccessException' 
		=> \application\handlers\UserExceptionHandler::class,
            'ItForFree\SimpleMVC\exceptions\SmvcRoutingException' 
		=> \application\handlers\UserExceptionHandler::class
        ],
        'user' => [ // подсистема авторизации
            'class' => \application\models\ExampleUser::class,
            'params' => [
                'session' => '@session',
                'param2' => 'param2',
                'param3' => 'param3',
                'param4' => 'param4',
                'param5' => 'param5'
            ]
        ],
        'session' => [ // подсистема работы с сессиями
            'class' => ItForFree\SimpleMVC\Session::class,
            'alias' => '@session'
        ]
    ]    
];

return $config;