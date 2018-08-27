<?php
namespace application\controllers;

class LoginController extends \ItForFree\SimpleMVC\mvc\Controller
{
    /** 
     * @var string Название страницы
     */
    public $loginTitle = "Регистрация/Вход в систему";
    
    protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
        'all' => ['allow' => ['logout'], 'deny' => ['login']], // общее правило
        //исключения далее отдельно для каждого метода
        'login' => ['allow' => ['guest']],  
        'logout' => ['deny' => ['guest']],
        
    ];
    
    /**
     * Вход в систему / Выводит на экран форму для входа в систему
     */
    public function loginAction()
    {
        if (!empty($_POST)) {
            $login = $_POST['userName'];
            $pass = $_POST['password'];
            $user = \ItForFree\SimpleMVC\User::get();
            if($user->login($login, $pass)) {
                $this->header(\ItForFree\SimpleMVC\Url::link("homepage/index"));
            }
            else {
                $this->header(\ItForFree\SimpleMVC\Url::link("login/login&auth=deny"));
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
        $this->header(\ItForFree\SimpleMVC\Url::link("login/login"));
    }
}


