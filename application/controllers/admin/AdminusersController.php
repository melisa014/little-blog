<?php
namespace application\controllers\admin;
use \application\models\Adminusers as Adminusers;
use ItForFree\SimpleMVC\Config;

/**
 *
 */
class AdminusersController extends \ItForFree\SimpleMVC\mvc\Controller
{
    
    public $layoutPath = 'admin-main.php';
    
    protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
         ['allow' => true, 'roles' => ['admin']],
         ['allow' => false, 'roles' => ['?', '@']],
    ];
    
    public function indexAction()
    {
        $Adminusers = new Adminusers();

        $userId = $_GET['id'] ?? null;
        
        if ($userId) { // если указан конктреный пользователь
            $viewAdminusers = $Adminusers->getById($_GET['id']);
            $this->view->addVar('viewAdminusers', $viewAdminusers);
            $this->view->render('user/view-item.php');
        } else { // выводим полный список
            
            $users = $Adminusers->getList()['results'];
            $this->view->addVar('users', $users);
            $this->view->render('user/index.php');
        }
    }

    /**
     * Выводит на экран форму для создания новой статьи (только для Администратора)
     */
    public function addAction()
    {
        $Url = Config::get('core.url.class');
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewUser'])) {
                $Adminusers = new Adminusers();
                $newAdminusers = $Adminusers->loadFromArray($_POST);
                $newAdminusers->insert(); 
                $this->redirect($Url::link("admin/adminusers/index"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/adminusers/index"));
            }
        }
        else {
            $addAdminusersTitle = "Регистрация пользователя";
            $this->view->addVar('addAdminusersTitle', $addAdminusersTitle);
            
            $this->view->render('user/add.php');
        }
    }
    
    /**
     * Выводит на экран форму для редактирования статьи (только для Администратора)
     */
    public function editAction()
    {
        $id = $_GET['id'];
        $Url = Config::get('core.url.class');
        
        if (!empty($_POST)) { // это выполняется нормально.
            
            if (!empty($_POST['saveChanges'] )) {
                $Adminusers = new Adminusers();
                $newAdminusers = $Adminusers->loadFromArray($_POST);
                $newAdminusers->update();
                $this->redirect($Url::link("admin/adminusers/index&id=$id"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/adminusers/index&id=$id"));
            }
        }
        else {
            $Adminusers = new Adminusers();
            $viewAdminusers = $Adminusers->getById($id);
            
            $editAdminusersTitle = "Редактирование данных пользователя";
            
            $this->view->addVar('viewAdminusers', $viewAdminusers);
            $this->view->addVar('editAdminusersTitle', $editAdminusersTitle);
            
            $this->view->render('user/edit.php');   
        }
        
    }
    
    /**
     * Выводит на экран предупреждение об удалении данных (только для Администратора)
     */
    public function deleteAction()
    {
        $id = $_GET['id'];
        $Url = Config::get('core.url.class');
        
        if (!empty($_POST)) {
            if (!empty($_POST['deleteUser'])) {
                $Adminusers = new Adminusers();
                $newAdminusers = $Adminusers->loadFromArray($_POST);
                $newAdminusers->delete();
                
                $this->redirect($Url::link("archive/allUsers"));
              
            }
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/adminusers/edit&id=$id"));
            }
        }
        else {
            
            $Adminusers = new Adminusers();
            $deletedAdminusers = $Adminusers->getById($id);
            $deleteAdminusersTitle = "Удаление статьи";
            
            $this->view->addVar('deleteAdminusersTitle', $deleteAdminusersTitle);
            $this->view->addVar('deletedAdminusers', $deletedAdminusers);
            
            $this->view->render('user/delete.php');
        }
    }
}
