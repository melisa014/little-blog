<?php
namespace application\controllers;
use \application\models\Article as Article;

class ArticleController extends \core\Controller
{
    /**
     * @var string Название страницы
     */
    public $viewArticleTitle = "Название статьи";
    
    public $viewArticleContent = "Содержание статьи";
    
    public $viewArticleDate = "";
    
    public $viewArticle = "";
    
    /**
     * Выводит на экран страницу "Статья" для просмотра
     */
    public function indexAction()
    {

        $Article = new Article();

        $this->viewArticle = $Article->getById($_GET['id']);
        
        $this->view->addVar('viewArticle', $this->viewArticle);
        
        $this->view->render('article/index.php');
    }
    
    /**
     * Выводит на экран страницу "Статья" для просмотра Администратору
     */
    public function indexAdminAction()
    {

        $Article = new Article();

        $this->viewArticle = $Article->getById($_GET['id']);
        
        $this->view->addVar('viewArticle', $this->viewArticle);
        
        $this->view->render('article/indexAdmin.php');
    }
    
    /**
     * Выводит на экран форму для создания новой статьи (только для Администратора)
     */
    public function addAdminAction()
    {
        if (!empty($_POST)) {
            if ($_POST['saveNewArticle'] == 'Сохранить') {
                $Article = new Article();
                $newArticle = $Article->loadFromPost();
                \DebugPrinter::debug($newArticle);
                $newArticle->insert();
                \DebugPrinter::debug($newArticle, 'после инсерта');
                $this->header('/index.php?action=homepage/index');
            
            } 
            elseif ($_POST['cancel'] == 'Назад') {
                $this->header("/index.php?action=homepage/index");
            }
        }
        else {
            $this->addArticleTitle = "Создание статьи";
            $this->view->addVar('addArticleTitle', $this->addArticleTitle);
            
            $this->view->render('article/addAdmin.php');
        }
    }
    
    /**
     * Выводит на экран форму для редактирования статьи (только для Администратора)
     */
    public function editAdminAction()
    {
        $id = $_GET['id'];
        
//        \DebugPrinter::debug($_POST);
//        \DebugPrinter::debug($id);
        
        if (!empty($_POST)) {
            if ($_POST['saveChanges'] == 'Сохранить') {
                $Article = new Article();
                $newArticle = $Article->loadFromPost();
                $newArticle->update();
                $this->header("index.php?action=article/index&id=$id");
            } 
            elseif ($_POST['cancel'] == 'Назад') {
                $this->header("index.php?action=article/index&id=$id");
            }
        }
        else {
            $Article = new Article();
            $this->viewArticle = $Article->getById($id);
            $this->editArticleTitle = "Редактирование статьи";
//            \DebugPrinter::debug($this->viewArticle);
            
            $this->view->addVar('viewArticle', $this->viewArticle);
            $this->view->addVar('editArticleTitle', $this->editArticleTitle);
            
            $this->view->render('article/editAdmin.php');   
        }
        
    }
    
    /**
     * Выводит на экран предупреждение об удалении данных (только для Администратора)
     */
    public function deleteAdminAction()
    {
        $id = $_GET['id'];
        
        if (!empty($_POST)) {
            if ($_POST['deleteArticle'] == 'Удалить') {
                $Article = new Article();
                $newArticle = $Article->loadFromPost();
                $newArticle->delete();
                $this->header('index.php?action=homepage/index');
              
            }
            elseif ($_POST['cancel'] == 'Вернуться') {
                $this->header("index.php?action=article/edit&id=$id");
            }
        }
        else {
            $this->deleteArticleTitle = "Удаление статьи";
            $this->view->addVar('deleteArticleTitle', $this->deleteArticleTitle);
            
            $this->view->render('article/deleteAdmin.php');
        }
    }
}
