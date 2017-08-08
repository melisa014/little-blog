<?php
namespace application\controllers;
use \application\models\Article as Article;
use \application\models\Category as Category;

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
     * Список правил, ограничивающих доступ пользователей с разными ролями
     * По общему правилу всем разрешено всё. 
     * Частные правила иллюстрируют исключения, и они более приоритетны
     * @var type array
     */
    protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
        'all' => ['allow' => ['admin', 'auth_user', 'guest']], // общее правило , 'deny' => ['guest']
        'delete' => ['deny' => ['auth_user', 'guest']], //исключения
        'edit' => ['allow' => ['auth_user'], 'deny' => ['guest']], 
        'add' => ['allow' => ['auth_user'], 'deny' => ['guest']],
        
    ];
    
    /**
     * Выводит на экран страницу "Статья" для просмотра
     */
    public function indexAction()
    {

        $Article = new Article();

        $viewArticle = $Article->getById($_GET['id'], $Article->tableName);
        
        $this->view->addVar('viewArticle', $viewArticle);
        
        $this->view->render('article/index.php');
    }
    
    /**
     * Выводит на экран форму для создания новой статьи (только для Администратора)
     */
    public function addAction()
    {
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewArticle'])) {
                $Article = new Article();
                $newArticle = $Article->loadFromArray($_POST);
//                \DebugPrinter::debug($newArticle);
                $newArticle->insert(); 
//                \DebugPrinter::debug($newArticle, 'после инсерта');
                $this->header(\Url::link("homepage/index"));
            
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->header(\Url::link("homepage/index"));
            }
        }
        else {
            $Category = new Category();
            $changeCategory = $Category->getList();
            $addArticleTitle = "Создание статьи";
            
            $this->view->addVar('addArticleTitle', $addArticleTitle);
            $this->view->addVar('changeCategory', $changeCategory);
                        
            $this->view->render('article/add.php');
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
            
            if (!empty($_POST['saveChanges'])) {
//                \DebugPrinter::debug('$_POST'); 
                $Article = new Article();
                $newArticle = $Article->loadFromArray($_POST);
//                \DebugPrinter::debug($newArticle);
//                \DebugPrinter::debug($id);
                $newArticle->update();
//                \DebugPrinter::debug($newArticle, 'после апдейт');
                $this->header(\Url::link("article/index&id=$id"));
                 
            } 
            elseif (!empty($_POST['cancel'])) {
//                \DebugPrinter::debug("Отмена операции");
                $this->header(\Url::link("article/index&id=$id"));
            }
        }
        else {
            $Article = new Article();
            $viewArticle = $Article->getById($id);
            $editArticleTitle = "Редактирование статьи";
//            \DebugPrinter::debug($this->viewArticle);
            
            $this->view->addVar('viewArticle', $viewArticle);
            $this->view->addVar('editArticleTitle', $editArticleTitle);
            
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
            if (!empty($_POST['deleteArticle'])) {
//                \DebugPrinter::debug('$_POST');
                $Article = new Article();
                $newArticle = $Article->loadFromArray($_POST);
                $newArticle->delete();
                
                $this->header(\Url::link("homepage/index"));
              
            }
            elseif (!empty($_POST['cancel'])) {
//                \DebugPrinter::debug("Отмена операции");
                $this->header(\Url::link("article/edit&id=$id"));
            }
        }
        else {
            
            $Article = new Article();
            $deletedArticle = $Article->getById($id);
            $deleteArticleTitle = "Удаление статьи";
//            \DebugPrinter::debug($deletedArticle); 
            
            $this->view->addVar('deleteArticleTitle', $deleteArticleTitle);
            $this->view->addVar('deletedArticle', $deletedArticle);
            
            $this->view->render('article/delete.php');
        }
    }
}
