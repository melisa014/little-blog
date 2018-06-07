<?php
namespace application\controllers;

class LoginController extends \core\mvc\Controller
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
            if($user->login($login, $pass)) {
                $this->header(\core\mvc\view\Url::link("homepage/index"));
            }
            else {
                $this->header(\core\mvc\view\Url::link("login/index&auth=deny"));
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
        $user = \core\User::get();
        $user->logout();
        $this->header(\core\mvc\view\Url::link("login/index"));
    }
}


