<?php

/**
 * Класс, сожержащий общие настройки проекта
 */
class Config
{
    /**
     * Имя пользователя Базы данных
     * @var string
     */
    static public $db_username = "root";
    
    /**
     * Пароль для соединения с Базой данных
     * @var mixed
     */
    static public $db_password = "12345";
    
    /**
     * Установка строгого режима вывода ошибок, предупреждений и уведомлений для отладки
     */
    static function debugReporting()
    {
        ini_set( "display_errors", true );
        error_reporting(E_ALL);
    }
    

    
    
}
