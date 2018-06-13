<?php
namespace application\controllers\admin;
use \application\models\Adminusers as Adminusers;

/**
 *
 */
class AdminusersController extends \ItForFree\SimpleMVC\mvc\Controller
{
    
    protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
        'all' => ['allow' => ['admin'], 'deny' => ['auth_user', 'guest']] // общее правило , 'deny' => ['guest']
    ];
    
    public function indexAction()
    {
        $Adminusers = new Adminusers();

        $viewAdminusers = $Adminusers->getById($_GET['id']);
        
        $this->view->addVar('viewAdminusers', $viewAdminusers);
        
        $this->view->render('user/index.php');
    }

    /**
     * Выводит на экран форму для создания новой статьи (только для Администратора)
     */
    public function addAction()
    {
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewUser'])) {
                $Adminusers = new Adminusers();
                $newAdminusers = $Adminusers->loadFromArray($_POST);
                $newAdminusers->insert(); 
                $this->header(\ItForFree\SimpleMVC\Url::link("archive/allUsers"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->header(\ItForFree\SimpleMVC\Url::link("archive/allUsers"));
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
        
        if (!empty($_POST)) { // это выполняется нормально.
            
            if (!empty($_POST['saveChanges'] )) {
                $Adminusers = new Adminusers();
                $newAdminusers = $Adminusers->loadFromArray($_POST);
                $newAdminusers->update();
                $this->header(\ItForFree\SimpleMVC\Url::link("admin/adminusers/index&id=$id"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->header(\ItForFree\SimpleMVC\Url::link("admin/adminusers/index&id=$id"));
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
        
        if (!empty($_POST)) {
            if (!empty($_POST['deleteUser'])) {
                $Adminusers = new Adminusers();
                $newAdminusers = $Adminusers->loadFromArray($_POST);
                $newAdminusers->delete();
                
                $this->header(\ItForFree\SimpleMVC\Url::link("archive/allUsers"));
              
            }
            elseif (!empty($_POST['cancel'])) {
                $this->header(\ItForFree\SimpleMVC\Url::link("admin/adminusers/edit&id=$id"));
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
