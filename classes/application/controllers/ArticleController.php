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
    
    /**
     * Выводит на экран страницу "Статья" для просмотра
     */
    public function indexAction()
    {

        $Article = (new Article())->getById($_GET['id']);

//        \DebugPrinter::debug($Article);
//        \DebugPrinter::debug($newArticle);
        
        $this->viewArticleDate = $Article->publicationDate; //date('d M Y H:i:s');
        $this->viewArticleTitle = $Article->title;
        $this->viewArticleContent = $Article->content;
        $this->viewArticleId = $Article->id;
        
        $this->view->addVar('viewArticleContent', $this->viewArticleContent);
        $this->view->addVar('viewArticleTitle', $this->viewArticleTitle);
        $this->view->addVar('viewArticleDate', $this->viewArticleDate);
        $this->view->addVar('viewArticleId', $this->viewArticleId);
        
        $this->view->render('article/index.php');
    }
    
    /**
     * Выводит на экран форму для создания новой статьи
     */
    public function addAction()
    {
        echo "Добавляю статью <br>";
        
        if (!empty($_POST)) {
            $Article = new Article();
            $Article->insert();
            echo "Статья добавлена";
        } 
        else {
            $this->view->render('article/add.php');
        }
    }
    
    /**
     * Выводит на экран форму для редактирования статьи
     */
    public function editAction()
    {
        if (!empty($_POST)) {
            $Article = new Article();
            $Article->update();
            unset($_POST);
            $this->view->render('article/edit.php', 'Статья изменена');
        } 
        else {
            $Article = (new Article())->getById($_GET['id']);
            
            $this->viewArticleDate = $Article->publicationDate; //date('d M Y H:i:s');
            $this->viewArticleTitle = $Article->title;
            $this->viewArticleContent = $Article->content;
            $this->viewArticleId = $Article->id;
            $this->viewArticleSummary = $Article->summary;
            $this->viewArticleCategoryId = $Article->categoryId;

            $this->view->addVar('viewArticleContent', $this->viewArticleContent);
            $this->view->addVar('viewArticleTitle', $this->viewArticleTitle);
            $this->view->addVar('viewArticleDate', $this->viewArticleDate);
            $this->view->addVar('viewArticleId', $this->viewArticleId);
            $this->view->addVar('viewArticleSummary', $this->viewArticleSummary);
            $this->view->addVar('viewArticleCategoryId', $this->viewArticleCategoryId);

            $this->view->render('article/edit.php');   
        }
        
    }
    
    /**
     * Выводит на экран предупреждение об удалении данных
     */
    public function deleteAction()
    {
        echo "Удаляю статью <br>";
        
        if (!empty($_POST)) {
            if ($_POST['ok'] == 'Удалить') {
                $Article = new Article();
                $Article->delete();
                $this->view->render('article/delete.php', 'Статья удалена');
              
            }
            elseif ($_POST['ok'] == 'Вернуться') {
                $id = $_GET['id'];
                $this->view->render("article/index.php?action=article/edit&id=$id");
            }
        }
        else {
            $this->view->render('article/delete.php');
        }
    }
}
