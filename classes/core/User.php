<?php
namespace core;

/**
 * Класс для работы с данными пользователя
 * @author qwe
 */
class User extends Session
{
    public $role = null;
    public $userName = null;

    /**
    * Вернёт объект юзера
    * 
    * @staticvar type $instance
    * @return \static
    */
    public static function get()
    {
        static $instance = null; // статическая переменная
        if (null === $instance) { // проверка существования
            $instance = new static();
        }
        return $instance;
    }
    
    /** 
     * скрываем конструктор для того чтобы класс нельзя было создать в обход getInstance 
     */
    protected function __construct()
    {
        if (!empty(Session::get()->session['user']['role'])
                && !empty(Session::get()->session['user']['userName'])) {
            $this->role =  Session::get()->session['user']['role'];
            $this->userName =  Session::get()->session['user']['userName'];
        }
    }
        
    /**
     * Присваивает данной сессии имя пользователя и роль в соответствии с полученными данными
     * @param type $userName
     * @param type $pass
     * @return boolean
     */
    public function login($login, $pass)
    {
        if ($this->checkAuthData($login, $pass)) {
            
            $role = $this->getRoleByUserName($login); 
            $this->role =  $role; 
            $this->userName = $login;
            Session::get()->session['user']['role'] = $role; 
            Session::get()->session['user']['userName'] = $login; 
        }
        return true;
    }
    
    /**
     * Получить роль по имени пользователя
     * @param type $userName
     * @return type
     */
    private function getRoleByUserName($userName)
    {
        $siteAuthData = \Config::$users;
        if (isset($siteAuthData[$userName])) {
            return $siteAuthData[$userName]['role'];
        }
    }
    
    /**
     * Проверяет, зарегистрирован ли данный пользователь
     * @param type $login
     * @param type $pass
     */
    private function checkAuthData($login, $pass)
    {
        $result = false;
        $siteAuthData = \Config::$users;
        if (isset($siteAuthData[$login])) {
            if ($siteAuthData[$login]['pass'] == $pass) {
                $result = true;
            }
        }
        return $result;
    }
    
    /**
     * Удаляет из Userа и Сессии данные об актуальной роли и мени пользователя
     */
    public function logout()
    {
        
        $this->role = "";
        $this->userName = ""; 
        Session::get()->session['user']['role'] = "";
        Session::get()->session['user']['userName'] = "";
//        session_destroy();
        return true;
    }
    
    /**
     * 
     * @param type $route
     */
    public function isAllowed($route)
    {
        $result = 'нельзя';
        $controllerClassName = "application\\controllers\\" . \Router::getControllerClassName($route);
        $controller = new $controllerClassName();
        $rules = $controller->getControllerRules();
        $action = $controller->getControllerActionName($route);
        echo "<br>" .  $controllerClassName . " Действие: " . $action;
        if ($controller->isEnabled($action)) {
            $result = 'можно';
        }
        echo "<br>Результат: " . $result;
        
        // — использовать его во вью для вывода элементов меню
//       $a = strpos($this->role, $this->rules[$route]);
//        if (!in_array($this->rules[$route] == )) {
//            return true;
//        }
//        else return false;
    }
 
    /**
     * 
     * @param type $route
     * @param type $elementHTML
     */
    public function returnIfAllowed($route, $elementHTML) 
    {
        if($this->isAllowed($route)) {
            return $elementHTML;
            }
        else return "";
          /*
             * если нельзя возвращает пустую строку.
             - А в строку можно какой-нить якорь, куда надо вствить ссылку 
             * сформированыю на основе html если у юзера есть права на маршрут.
           * типа   User::get->returnIfAllowed( 'article/add', 
           *                '"<a htrf="::link::"> добавить статью</a>")
           * 
           * — это бы позволило полностью инкапсулировать вывод элемента 
           * управления в зависимости от роли пользователя.
             */
    }
    
}
