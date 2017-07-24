<?php
namespace application\controllers;

class LoginController extends \core\Controller
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
            $user = \core\User::get();
            $user->login($login, $pass);
            
            $_SESSION['test'] = "я пишусь";
            
            $this->header(\Url::link("homepage/index"));
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
        $user = \core\User::get();
        $user->logout();
        $this->header(\Url::link("login/index"));
    }
}


