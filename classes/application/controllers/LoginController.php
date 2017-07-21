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
            if (($_POST['username'] == \Config::$admin_username) && ($_POST['password'] == \Config::$admin_password)) {
                    $_SESSION['username'] = \Config::$admin_username;
                    $_SESSION['like'] = 0;
                    \DebugPrinter::debug($_SESSION);
                    $this->header('index.php?action=homepage/index');
                }
            else {
                $this->view->addVar('loginTitle', $this->loginTitle);
                $this->view->render('login/index.php', "Неверное имя пользователя или пароль");
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
    public function logoutAdminAction()
    {
        unset($_SESSION['username']);
        unset($_SESSION['like']);
        $this->header('index.php?action=login/index');
    }
}


