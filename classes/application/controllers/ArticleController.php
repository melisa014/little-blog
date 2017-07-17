<?php
namespace application\controllers;
use \application\models\Article as Article;

class ArticleController extends \core\Controller
{
    public $viewArticleTitle = "Название статьи";
    
    public $viewArticleContent = "Содержание статьи";
    
    public $viewArticleDate = "";
    
    /**
     * 
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
    
    public function addAction()
    {
        echo "Добавляю статью";
    }
    
    public function editAction()
    {
        echo "Редактирую статью";
    }
    
    public function deleteAction()
    {
        echo "Удаляю статью";
    }
}
