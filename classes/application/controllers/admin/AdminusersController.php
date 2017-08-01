<?php
namespace application\controllers\admin;
use \application\models\Adminusers as Adminusers;

/**
 *
 */
class AdminusersController extends \core\Controller
{
    
     protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
        'all' => ['allow' => ['admin'], 'deny' => ['auth_user', 'guest']] // общее правило , 'deny' => ['guest']
//        'delete' => ['deny' => ['auth_user', 'guest']], //исключения
//        'edit' => ['deny' => ['auth_user', 'guest']], 
//        'add' => ['deny' => ['auth_user', 'guest']],
        
    ];
    
    public function indexAction()
    {
        $Adminusers = new Adminusers();

        $this->viewAdminusers = $Adminusers->getById($_GET['id']);
        \DebugPrinter::debug($this->viewAdminusers);
        
        $this->view->addVar('viewAdminusers', $this->viewAdminusers);
        
        $this->view->render('user/index.php');
    }
    
    
    /**
     * Выводит на экран форму для создания новой статьи (только для Администратора)
     */
    public function addAction()
    {
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewUser'])) {
//                \DebugPrinter::debug($_POST['myemail']);
                
                $Adminusers = new Adminusers();
                $newAdminusers = $Adminusers->loadFromPost();
//                \DebugPrinter::debug($newAdminusers);
//                die();
                $newAdminusers->insert(); 
//                \DebugPrinter::debug($newAdminusers, 'после инсерта');
//                die();
                $this->header(\Url::link("archive/allUsers"));
            
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->header(\Url::link("archive/allUsers"));
            }
        }
        else {
            $this->addAdminusersTitle = "Регистрация пользователя";
            $this->view->addVar('addAdminusersTitle', $this->addAdminusersTitle);
            
            $this->view->render('user/add.php');
        }
    }
    
    /**
     * Выводит на экран форму для редактирования статьи (только для Администратора)
     */
    public function editAction()
    {
        $id = $_GET['id'];
        
//        \DebugPrinter::debug($_POST); 
//        \DebugPrinter::debug($id); 
        
        if (!empty($_POST)) { // это выполняется нормально.
            
            if (!empty($_POST['saveChanges'] )) {
//                \DebugPrinter::debug('$_POST'); 
                $Adminusers = new Adminusers();
                $newAdminusers = $Adminusers->loadFromPost();
//                \DebugPrinter::debug($newArticle);
//                \DebugPrinter::debug($id);
                $newAdminusers->update();
//                \DebugPrinter::debug($newArticle, 'после апдейт');
                $this->header(\Url::link("admin/adminusers/index&id=$id"));
                 
            } 
            elseif (!empty($_POST['cancel'])) {
//                \DebugPrinter::debug("Отмена операции");
                $this->header(\Url::link("admin/adminusers/index&id=$id"));
            }
        }
        else {
//            \DebugPrinter::debug("Только загрузка формы");
            $Adminusers = new Adminusers();
            $this->viewAdminusers = $Adminusers->getById($id);
            
            $this->editAdminusersTitle = "Редактирование данных пользователя";
//            \DebugPrinter::debug($this->viewArticle);
            
            $this->view->addVar('viewAdminusers', $this->viewAdminusers);
            $this->view->addVar('editAdminusersTitle', $this->editAdminusersTitle);
            
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
//                \DebugPrinter::debug('$_POST');
                $Adminusers = new Adminusers();
                $newAdminusers = $Adminusers->loadFromPost();
                $newAdminusers->delete();
                
                $this->header(\Url::link("archive/allUsers"));
              
            }
            elseif (!empty($_POST['cancel'])) {
//                \DebugPrinter::debug("Отмена операции");
                $this->header(\Url::link("admin/adminusers/edit&id=$id"));
            }
        }
        else {
            
            $Adminusers = new Adminusers();
            $deletedAdminusers = $Adminusers->getById($id);
            $this->deleteAdminusersTitle = "Удаление статьи";
//            \DebugPrinter::debug($deletedArticle); 
            
            $this->view->addVar('deleteAdminusersTitle', $this->deleteAdminusersTitle);
            $this->view->addVar('deletedAdminusers', $deletedAdminusers);
            
            $this->view->render('user/delete.php');
        }
    }
}
