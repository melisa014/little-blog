<?php

/**
 * Класс, содержащий общие настройки проекта
 */
class Config
{
    /**
     * Данные для подключения к БД
     */
    static public $db_dsn = "mysql:host=localhost;dbname=blog";
    /**
     * Имя пользователя Базы данных
     * @var string
     */
    static public $db_username = "root";
    
    
    /**
     * Пароль для соединения с Базой данных
     * @var mixed
     */
    static public $db_password = "1234";
   
    /**
     * Авторизационные данные пользователей
     */
    static public $users = [
        'admin' => [
            'role' => 'admin',
            'pass' => 'mypass'
        ],
        'user1' => [
            'role' => 'auth_user',
            'pass' => 'rf34rq34t'
        ],
        'user2' => [
            'role' => 'auth_user',
            'pass' => '76543'
        ],
       
    ];
    
    
    /**
     * Установка строгого режима вывода ошибок, предупреждений и уведомлений для отладки
     */
    static function debugReporting()
    {
        ini_set( "display_errors", true );
        error_reporting(E_ALL);
    }
    

    
    
}
