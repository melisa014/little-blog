<?php
namespace core\traits;

/* 
 * Система контроля доступа
 */
trait AccessControl {
     
   /**
    * Массив, содержащий имена методов, доступных пользователю с данной ролью
    * (должен переопределяться в контроллерах)
    * @var array 
    */ 
   protected $rules = [];
    
   function __construct()
   {
       //$this->user = new \core\User();
   }
   
    /**
     * Запускает метод класса ***Controller полученный через GET-параметр
     * @param type 
     */
    public function callAction($route) 
    {
        $actionName = $this->getControllerActionName($route);
//        \DebugPrinter::debug($actionName, 'actionName (callAction)');
        
        if ($this->isEnabled($actionName)) {
            $methodName =  $this->getControllerMethodName($actionName);
//            \DebugPrinter::debug($methodName, 'methodName (callAction)');
            $this->$methodName();
        } else {
            throw  new \Exception("Доступ запрещен");
        }
    }
    
   /**
    * Есть ли у данного пользователя разрешение на это действие 
    */
    public function isEnabled($actionName)
    {
        $result = true;
        if ($this->isInRules($actionName) 
//                && (User::get()->role != $this->rules[$actionName]))
                &&  (in_array(\core\User::get()->role, $this->rules[$actionName])))
        {
            $result  = false;
        }

        return $result;
    }

    /**
     * Упоминается ли действие в правилах
     */
    private function isInRules($actionName)
    {
        if (isset($rules[$actionName])) {
            return true;
        }
        return false;
    }
    
    /**
     * Формирует полное имя метода контроллера по GET-параметру
     * @param type $route -- строка GET-параметр
     */
    public function getControllerActionName($route)
    {
         $result =  'index';
         
        $urlFragments = explode('/', $route);
         if (!empty($urlFragments[1])) {
             $result = $urlFragments[1];
         } 
         
         return $result;
         
    }
    
        
    /**
     * Формирует имя метода контроллера по GET-параметру
     * @param type $action -- строка GET-параметр
     */
    public function getControllerMethodName($action)
    {
        return $action . 'Action';
    }
    
    }
