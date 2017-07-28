<?php

namespace core;

/**
 * Класс для работы с массивом $_SESSION
 *
 * @author qwe
 */
class Session 
{
    public $session = null; //$_SESSION
    
    /**
    * Вернёт объект класса Session
    * 
    * @staticvar type $instance
    * @return \static
    */
    public static function get()
    {
        static $instance = null; // статическая переменная
        if (null === $instance) { // проверка существования
            $instance = new static();
        }
        return $instance;
    }
    
    /*скрываем конструктор
    - для того чтобы класс нельзя было создать в обход getInstance */
    protected function __construct()
    {   
        session_start();
        $this->session = &$_SESSION;
        
    }
    
}
