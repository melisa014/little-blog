<?php

/**
 * Класс-маршрутизатор
 */

class Router
{
    /**
     * Передаёт управление разным контроллерам в зависимости от URL
     */
    public function __construct($route)
    {
//        \DebugPrinter::debug($_SESSION['username']);
//        echo "<br>";
        
        $controllersName = "application\\controllers\\". $this->getControllerClassName($route);
       // $methodsName = $this->getControllerActionName($action);
//        echo $controllersName. "<br>";
//        echo $methodsName. "<br><br>";
        $controller = new $controllersName();
        $controller->callAction($route);
        // $controller->$methodsName();
        
    }
    
    /**
     * Формирует имя конроллера по GET-параметру
     * @param type $route -- строка GET-параметр
     */
    public function getControllerClassName($route)
    {
        $result = 'Homepage';
                
        $urlFragments = explode('/', $route);
        if (!empty($urlFragments[0])) {
            
            $firstletterToUp = ucwords($urlFragments[0]);
//            \DebugPrinter::debug($firstletterToUp);
            
            $result = $firstletterToUp;
        } 
         
        return $result. "Controller";
    }
    

}
