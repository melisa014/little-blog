<?php
namespace application\controllers\admin;
use \application\models\Adminusers as Adminusers;

/**
 *
 */
class AdminusersController extends \core\Controller
{
    
     protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
        'all' => ['allow' => ['admin', 'auth_user', 'guest']], // общее правило , 'deny' => ['guest']
        'delete' => ['deny' => ['auth_user', 'guest']], //исключения
        'edit' => ['allow' => ['auth_user'], 'deny' => ['guest']], 
        'add' => ['allow' => ['auth_user'], 'deny' => ['guest']],
        
    ];
    
    public function indexAction()
    {
        $Adminusers = new Adminusers();

        $this->viewAdminusers = $Adminusers->getById($_GET['id']);
        
        $this->view->addVar('viewAdminusers', $this->viewAdminusers);
        
        $this->view->render('user/index.php');
    }
    
    
    /**
     * Выводит на экран форму для создания новой статьи (только для Администратора)
     */
    public function addAction()
    {
        if (!empty($_POST)) {
            if ($_POST['saveNewUser'] == 'Сохранить') {
                $Adminusers = new Adminusers();
                $newAdminusers = $Adminusers->loadFromPost();
//                \DebugPrinter::debug($newArticle);
                $newAdminusers->insert(); 
//                \DebugPrinter::debug($newArticle, 'после инсерта');
                $this->header(\Url::link("archive/allUsers"));
            
            } 
            elseif ($_POST['cancel'] == 'Назад') {
                $this->header(Url::link("archive/allUsers"));
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
            
            if ($_POST['saveChanges'] == 'Сохранить') {
//                \DebugPrinter::debug('$_POST'); 
                $Article = new Article();
                $newArticle = $Article->loadFromPost();
//                \DebugPrinter::debug($newArticle);
//                \DebugPrinter::debug($id);
                $newArticle->update();
//                \DebugPrinter::debug($newArticle, 'после апдейт');
                $this->header(\Url::link("article/index&id=$id"));
                 
            } 
            elseif ($_POST['cancel'] == 'Назад') {
//                \DebugPrinter::debug("Отмена операции");
                $this->header(\Url::link("article/index&id=$id"));
            }
        }
        else {
//            \DebugPrinter::debug("Только загрузка формы");
            $Article = new Article();
            $this->viewArticle = $Article->getById($id);
            $this->editArticleTitle = "Редактирование статьи";
//            \DebugPrinter::debug($this->viewArticle);
            
            $this->view->addVar('viewArticle', $this->viewArticle);
            $this->view->addVar('editArticleTitle', $this->editArticleTitle);
            
            $this->view->render('article/edit.php');   
        }
        
    }
    
    /**
     * Выводит на экран предупреждение об удалении данных (только для Администратора)
     */
    public function deleteAction()
    {
        $id = $_GET['id'];
        
        if (!empty($_POST)) {
            if ($_POST['deleteArticle'] == 'Удалить') {
//                \DebugPrinter::debug('$_POST');
                $Article = new Article();
                $newArticle = $Article->loadFromPost();
                $newArticle->delete();
                
                $this->header(\Url::link("homepage/index"));
              
            }
            elseif ($_POST['cancel'] == 'Вернуться') {
//                \DebugPrinter::debug("Отмена операции");
                $this->header(\Url::link("article/edit&id=$id"));
            }
        }
        else {
            
            $Article = new Article();
            $deletedArticle = $Article->getById($id);
            $this->deleteArticleTitle = "Удаление статьи";
//            \DebugPrinter::debug($deletedArticle); 
            
            $this->view->addVar('deleteArticleTitle', $this->deleteArticleTitle);
            $this->view->addVar('deletedArticle', $deletedArticle);
            
            $this->view->render('article/delete.php');
        }
    }
}
