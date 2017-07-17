<?php
namespace application\controllers;
use \application\models\Article as Article;

class ViewArticleController extends \core\Controller
{
    public $viewArticleTitle = "Название статьи";
    
    public $viewArticleContent = "Содержание статьи";
    
    public $viewArticleDate = "";
    
    /**
     * 
     */
    public function run()
    {
        $viewArticleDate = date('d M Y H:i:s');
//        $this->articleTitle = Article::getById()->title;
//        $content = Article::getById()->content;//"Здесь должно быть содержание статьи"
//        $date = Article::getById()->publicationDate;
        
        $this->view->addVar('viewArticleContent', $this->viewArticleContent);
        $this->view->addVar('viewArticleTitle', $this->viewArticleTitle);
        $this->view->addVar('viewArticleDate', $viewArticleDate);
        
        $this->view->render('article/index.php');
    }
}
