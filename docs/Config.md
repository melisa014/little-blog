
# Конфигурация приложения. SimpleMVC

* Конфигурация приложения задается в файле `application/config/web.php` и содержит  в основном значения, которые используются Ядром приложения, этот файл имеет вид ([см. исходный код](https://github.com/it-for-free/SimpleMVC-example/blob/master/application/config/web.php#L1)):
```php
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
            'class' => \application\models\ExampleUser::class
        ],
        'session' => [ // подсистема работы с сессиями
            'class' => ItForFree\SimpleMVC\Session::class
        ]
    ]    
];

return $config;
```

* Чтобы переопределить необходимые вам значений, используйте локальный конфиг `application/config/web-local.php`, например для _переопределения_ настроек БД нужен будет код вида (используем _те же самые ветки массива_, что и в основном конфиге, но _с новыми значениями_):
```php
<?php

$config = [
    'core' => [ // подмассив используемый самим ядром фреймворка
        'db' => [ // подмассив конфигурации БД
            'dns' => 'mysql:host=localhost;dbname=smvc',
            'username' => 'root',
            'password' => '12345'
        ]
    ]    
];
return $config;
```








