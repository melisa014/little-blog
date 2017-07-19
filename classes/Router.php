<?php

/**
 * Класс-маршрутизатор
 */

class Router
{
    /**
     * Передаёт управление разным контроллерам в зависимости от URL
     */
    public function __construct($action)
    {
//        \DebugPrinter::debug($_SESSION['username']);
//        echo "<br>";
        
        $controllersName = "application\\controllers\\". $this->getControllerClassName($action);
        $methodsName = $this->getControllerActionName($action);
//        echo $controllersName. "<br>";
//        echo $methodsName. "<br><br>";
        $controller = new $controllersName();
        $controller->$methodsName();
        
    }
    
    /**
     * Формирует имя конроллера по GET-параметру
     * @param type $action -- строка GET-параметр
     */
    public function getControllerClassName($action)
    {
        $result = 'Homepage';
                
        $urlFragments = explode('/', $action);
        if (!empty($urlFragments[0])) {
            
            $firstletterToUp = ucwords($urlFragments[0]);
//            \DebugPrinter::debug($firstletterToUp);
            
            $result = $firstletterToUp;
        } 
         
         return $result. "Controller";
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
