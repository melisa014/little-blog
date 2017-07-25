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
        
        if ($this->isEnabled($route, $actionName)) {
            $methodName =  $this->getControllerMethodName($actionName);
//            \DebugPrinter::debug($methodName, 'methodName (callAction)');
            $this->$methodName();
        } else {
            throw  new \Exception("Доступ запрещен");
        }
    }
    
    public function IsEnabled($route, $actionName)
    {
        if ($this->isRules($route)) {
            
            $rules = $this->rules;
            
            \DebugPrinter::debug($actionName, 'Действие ');
            \DebugPrinter::debug(\core\User::get()->role, 'Роль');
            \DebugPrinter::debug($rules, 'Правила в данном контроллере есть');
            
            foreach ($rules as $action => $rule) {
                if ($action == $actionName) {
                    foreach ($rule as $status => $userRole) {
                        if ($status == 'deny') {
                            foreach ($userRole as $k => $role) {
                                if (\core\User::get()->role == $role) {
                                    return false;
                                }
                            }
                        }   
                        elseif ($status == 'allow') {
                            foreach ($userRole as $k => $role) {
                                if (\core\User::get()->role == $role) {
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
            foreach ($rules as $action => $rule) {
                if ($action == 'all') {
                    foreach ($rule as $status => $userRole) {
                        if ($status == 'deny') {
                            foreach ($userRole as $k => $role) {
                                if (\core\User::get()->role == $role) {
                                    return false;
                                }
                            }
                        }   
                        elseif ($status == 'allow') {
                            foreach ($userRole as $k => $role) {
                                if (\core\User::get()->role == $role) {
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
            
            
        }
        else {
            echo "В данном контроллере правил нет";
            return true;
        }
    }
    
   /**
    * Есть ли у данного пользователя разрешение на это действие 
    */
//    public function isEnabled($actionName)
//    {
//        $result = true;
//        $condition = in_array(\core\User::get()->role, $this->rules[$actionName]);
//        \DebugPrinter::debug($condition, 'Есть ли роль в рулз?');
//        if ($this->isInRules($actionName) 
////                && (User::get()->role != $this->rules[$actionName]))
//                &&  ($condition))
//        {
//            $result  = false;
//        }
//
//        return $result;
//    }
    
    /**
     * Есть ли правила в данном контроллере
     */
    private function isRules($route)
    {
        $controllerClassName = "application\\controllers\\" . \Router::getControllerClassName($route);
        $controller = new $controllerClassName();
        if (!empty($controller->rules)) {
            return true;
        }
        return false;
    }
    
    /**
     * Получить правило по роли
     */
//    public function getRuleByRole($role)
//    {
//        ...
//        if ((\core\User::get()->role == $role)
//                && ($status = 'allow')) {
//            return true;
//        }
//        elseif ((\core\User::get()->role == $role)
//                && ($status = 'deny')) {
//            return false;
//        }
//    }

    /**
     * Есть ли частное правило для данного действия
     */
//    private function isInRules($actionName)
//    {
//        $rules = $this->rules;
//        foreach ($rules as $action => $rule) {
//            if ($action == $actionName) {
//                return true;
//            }
//            else return false;
//        }
//    }
    
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
    
    /**
     * Возвращает массив с правилами данного контроллера 
     * @return array['action'] = 'user'
     */
    public function getControllerRules()
    {
//        $controllerClassName = static::class;
//        $obj = new $controllerClassName;
        return $this->rules;
    }
}
    
