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

//        echo $controllersName;   
        
        $controller = new $controllersName();
        
//        \DebugPrinter::debug($controller);
       // die();
        $controller->callAction($route);
        
    }
    
    /**
     * Простой вариант поиска имени класса
     */
//    public static function getControllerClassName($route)
//    {
//        $result = 'Homepage';
//                
//        $urlFragments = explode('/', $route);
//        if (!empty($urlFragments[0])) {
//            
//            $firstletterToUp = ucwords($urlFragments[0]);
////            \DebugPrinter::debug($firstletterToUp);
//            
//            $result = $firstletterToUp;
//        } 
//         
//        return $result. "Controller";
//    }
    
    
    
    public static function getControllerClassName($route)
    {
        $result = 'Homepage';
                
        $urlFragments = explode('/', $route);
        
        if (!empty($urlFragments[0])) {
            
            $result = "";
            
            $classNameIndex = count($urlFragments)-2;
            $className = $urlFragments[$classNameIndex];
            $firstletterToUp = ucwords($className); // поднимаем первую букву в имени класса
            if (count($urlFragments) > 2) {  // следовательно присутствует доп подпространство внутри кcontrollers
                $i = 0;
                while($i < $classNameIndex) {
                    $result .= $urlFragments[$i] . "\\"; //прибавляем подпространство к имени класса
                    $i++;
                }
            }
            $result .= $firstletterToUp;
//            \DebugPrinter::debug($result, 'результат после сложения неймспейса и имени контроллера');
        } 
        return $result. "Controller";
    }
    
}
