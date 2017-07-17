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
        $act = isset( $_GET['action'] ) ? $_GET['action'] : "";
        return $act;
    }
    
}

