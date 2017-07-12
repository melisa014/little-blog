<?php

/**
 * Класс для разбора URL
 */
class Url
{
    /**
     * Получаем URL
     */
    public static function getAction()
    {
        return isset( $_GET['action'] ) ? $_GET['action'] : "";
    }
    
}

