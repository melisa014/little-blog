<?php
namespace application\controllers;
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

class LoginController extends \ItForFree\SimpleMVC\mvc\Controller
{
    
    /**
     * {@inheritDoc}
     */
    public $layoutPath = 'main.php';
        
    /** 
     * @var string Название страницы
     */
    public $loginTitle = "Регистрация/Вход в систему";
    
    protected $rules = [ 
        ['allow' => true, 'roles' => ['?'], 'actions' => ['login']],
        ['allow' => true, 'roles' => ['@'], 'actions' => ['logout']],
    ];
    
    /**
     * Вход в систему / Выводит на экран форму для входа в систему
     */
    public function loginAction()
    {
        if (!empty($_POST)) {
            $login = $_POST['userName'];
            $pass = $_POST['password'];
            $User = Config::getObject('core.user.class');
            if($User->login($login, $pass)) {
                $this->redirect(Url::link("homepage/index"));
            }
            else {
                $this->redirect(Url::link("login/login&auth=deny"));
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
        $User = Config::getObject('core.user.class');
        $User->logout();
        $this->redirect(Url::link("login/login"));
    }
}


