<?php

/* 
 * Система контроля доступа
 */
namespace core\traits;
/**
 * Description of AccessControl
 *
 * @author qwe
 */
trait AccessControl {
     
   /**
    *
    * 
    * @var type 
    */ 

   
   protected $rules = [];
    
   function __construct()
   {
       //$this->user = new \core\User();

   }
   
    /**
     * 
     * @param type $actionName
     */
    public function callAction($route) 
    {
        $actionName = $this->getControllerActionName($route);
        
        if ($this->isEnabled($actionName)) {
            $methodName =  $this->getControllerMethodName($actionName);
            $this->$methodName();
        } else {
            throw  new \Exception("Доступ запрещен");
        }
    }
   
    public function isEnabled($actionName)
    {
        $result = true;
        if ($this->isInRules($actionName) 
                && (User::get()->role != $this->rules[$actionName]))
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
     * Формирует имя метода контроллера по GET-параметру
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
         $result =  'index';
         
        $urlFragments = explode('/', $action);
         if (!empty($urlFragments[1])) {
             $result = $urlFragments[1];
         } 
         
         return $result . 'Action';
         
    }
    
    
}
