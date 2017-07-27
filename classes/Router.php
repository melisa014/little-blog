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
        
        // тут тоже относительный адрес пространства был -- спасало только то, что сам класс в корневом пространстве
        $controllersName = "\\application\\controllers\\". self::getControllerClassName($route);
       // $methodsName = $this->getControllerActionName($action);
//        echo $controllersName. "<br>";
//        echo $methodsName. "<br><br>";
        
       // echo $controllersName;   die();
        $controller = new $controllersName();
       // die();
        $controller->callAction($route);
        // $controller->$methodsName();
        
    }
    
    /**
     * Формирует имя конроллера по GET-параметру
     * @param type $route -- строка GET-параметр
     */
    public static function getControllerClassName($route)
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
