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
   public $user = null;
   
   protected $rules = [];
    
   function __construct()
   {
       $this->user = new \core\User();

   }
   
    /**
     * 
     * @param type $actionName
     */
    public function callAction($actionName) {
        if ($this->allow($actionName)) {
            $methodName =  $this->getControllerActionName($actionName);
            $this->$methodName();
        } else {
            throw  new \Exception("Доступ запрещен");
        }
    }
   
   public function allow($actionName)
   {
       $result = true;
       if ($this->isInRules($actionName) 
               && ($this->user->role != $this->rules[$actionName]))
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
      return false; // сделать проверку $this->rules 
   }
}
