<?php

namespace core;
/**
 * Базовый класс для работы с конроллерами
 */
class Controller 
{
    use \core\traits\AccessControl;
    
    /**
     * @var object Хранит экземпляр класса View
     */
    public $view = null;
    
    
   
    /**
     * Создаёт экземпляр класса View для работы с представлениями
     */
    public function __construct() {
        $this->view = new View();
       // \DebugPrinter::debug($this->view);
    }
    
    public function header($path) { // 302 редирет
        header ("Location: $path");
    }
    
    
    
    
    /**
     * Формирует имя метода контроллера по GET-параметру
     * @param type $action -- строка GET-параметр
     */
    public function getControllerActionName($action)
    {
         $result =  'index';
         
        $urlFragments = explode('/', $action);
         if (!empty($urlFragments[1])) {
             $result = $urlFragments[1];
         } 
         if (isset($_SESSION['username'])) {
             $result .= 'Admin'; 
         }
         
         return $result . 'Action';
         
    }
    
}

