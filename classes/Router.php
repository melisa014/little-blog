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

        $controllersName = "application\\controllers\\". $this->getControllerClassName($action)."Controller";
        $methodsName = $this->getControllerActionName($action);
//        echo $controllersName;
//        echo $methodsName;
        $controller = new $controllersName();
        $controller->$methodsName();
        
    }
    
    /**
     * 
     * @param type $action -- строка GET-параметр
     */
    public function getControllerClassName($action)
    {
        $result = 'Homepage';
                
        $urlFragments = explode('/', $action);
        if (!empty($urlFragments[0])) {
            
            $firstletterToUp = ucwords($urlFragments[0]);
            \DebugPrinter::debug($firstletterToUp);
            
            $result = $firstletterToUp; //. 'Controller'
         } 
         
         return $result;
    }
    
    /**
     * 
     * @param type $action -- строка GET-параметр
     */
    public function getControllerActionName($action)
    {
         $result =  'indexAction';
         
        $urlFragments = explode('/', $action);
         if (!empty($urlFragments[1])) {
             $result = $urlFragments[1] . 'Action' ;
         } 
         
         return $result;
         
    }
}
