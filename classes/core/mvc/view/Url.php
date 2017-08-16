<?php
namespace core\mvc\view;

/**
 * Класс для разбора URL
 */
class Url
{
    /**
     * Получаем URL
     */
    public static function getRoute()
    {
        $act = isset( $_GET['route'] ) ? $_GET['route'] : "";
        return $act;
    }
    
   
            
    public static function link($route)
    {
        $path = "/index.php?route=$route"; 
        return $path;
    }
}

