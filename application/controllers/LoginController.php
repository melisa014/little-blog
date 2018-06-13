<?php
namespace application\controllers;

class LoginController extends \ItForFree\SimpleMVC\mvc\Controller
{
    /** 
     * @var string Название страницы
     */
    public $loginTitle = "Регистрация/Вход в систему";
    
    /**
     * Вход в систему / Выводит на экран форму для входа в систему
     */
    public function indexAction()
    {
        if (!empty($_POST)) {
            $login = $_POST['userName'];
            $pass = $_POST['password'];
            $user = \ItForFree\SimpleMVC\User::get();
            if($user->login($login, $pass)) {
                $this->header(\ItForFree\SimpleMVC\Url::link("homepage/index"));
            }
            else {
                $this->header(\ItForFree\SimpleMVC\Url::link("login/index&auth=deny"));
            }
        }
        else {
            $this->view->addVar('loginTitle', $this->loginTitle);
            
            $this->view->render('login/index.php');
        }
    }
    
    /**
     * Выход из системы
     */
    public function logoutAction()
    {
        $user = \ItForFree\SimpleMVC\User::get();
        $user->logout();
        $this->header(\ItForFree\SimpleMVC\Url::link("login/index"));
    }
}


