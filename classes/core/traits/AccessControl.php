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
            
            if (!empty($rules[$actionName])) {
                if (!empty($rules[$actionName]['deny'])) {
                    foreach ($rules[$actionName]['deny'] as $k => $role) {
                        if (\core\User::get()->role == $role) {
                            return false;
                        }
                    }
                }   
                if (!empty($rules[$actionName]['allow'])) {
                    foreach ($rules[$actionName]['allow'] as $k => $role) {
                        if (\core\User::get()->role == $role) {
                            return true;
                        }
                    }
                }
            }
            
            if (!empty($rules['all'])) {
                if (!empty($rules['all']['deny'])) {
                    foreach ($rules['all']['deny'] as $k => $role) {
                        if (\core\User::get()->role == $role) {
                            return false;
                        }
                    }
                }   
                if (!empty($rules['all']['allow'])) {
                    foreach ($rules['all']['allow'] as $k => $role) {
                        if (\core\User::get()->role == $role) {
                            return true;
                        }
                    }
                }
            }
        }
        else {
//            echo "В данном контроллере правил нет";
            return true;
        }
    }
    
    /**
     * Есть ли правила в данном контроллере
     */
    private function isRules($route)
    {
        $controllerClassName = "\\application\\controllers\\" . \core\Router::getControllerClassName($route);
        $controller = new $controllerClassName();
        if (!empty($controller->rules)) {
            return true;
        }
        return false;
    }
    
    /**
     * Возвращает массив с правилами данного контроллера 
     * @return array['action'] = 'user'
     */
    public function getControllerRules()
    {
        return $this->rules;
    }
    
     /**
     * Формирует полное имя метода контроллера по GET-параметру
     * @param type $route -- строка GET-параметр
     */
    public function getControllerActionName($route)
    {
         $result =  'index';
         
        $urlFragments = explode('/', $route);
        $n = count($urlFragments);
        if (!empty($urlFragments[$n-1])) {
            $result = $urlFragments[$n-1];
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
    
