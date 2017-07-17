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
     * Установка строгого режима вывода ошибок, предупреждений и уведомлений для отладки
     */
    static function debugReporting()
    {
        ini_set( "display_errors", true );
        error_reporting(E_ALL);
    }
    

    
    
}
