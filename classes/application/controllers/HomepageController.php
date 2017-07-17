<?php
namespace application\controllers;
use \application\models\Article as Article;

class HomepageController extends \core\Controller
{
    public $homepageTitle = "Домашняя страница";
    
    /**
     * 
     */
    public function indexAction()
    {
        $Article = new Article();
//        \DebugPrinter::debug($Article);
        $homepageArticles = $Article->getList();
           
        $this->view->addVar('homepageArticles', $homepageArticles);
        $this->view->addVar('homepageTitle', $this->homepageTitle);
        
        $this->view->render('homepage/index.php');
        
    }
}

