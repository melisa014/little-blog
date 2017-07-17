<?php

/**
 * Класс-маршрутизатор
 */

use application\controllers as controllers;

class Router
{
    /**
     * Передаёт управление разным контроллерам в зависимости от URL
     */
    public function __construct($action)
    {
        switch ($action) {
        case 'archive':
            
            $controller =  new controllers\ArchiveController(); 
            $controller->run() ; // передаем управление
            break;
        case 'viewArticle':
            $controller =  new controllers\ViewArticleController(); 
            $controller->run() ; // передаем управление
            break;
        default:
            $controller =  new controllers\HomepageController(); 
           // \DebugPrinter::debug($controller->view);
            $controller->run() ; // передаем управление
        }
    }
    
}
