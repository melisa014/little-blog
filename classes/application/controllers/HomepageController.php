<?php
namespace application\controllers;
use \application\models\Article as Article;
use \core\Model as Model;

class HomepageController extends \core\Controller
{
    public $homepageTitle = "Домашняя страница";
    
    /**
     * 
     */
    public function run()
    {
        $Model = new Model();
        \DebugPrinter::debug($Model);
        $Article = new Article();
        \DebugPrinter::debug($Article);
        $homepageArticles = $Article->getById(1);
           
        $this->view->addVar('homepageArticles', $homepageArticles);
        $this->view->addVar('homepageTitle', $this->homepageTitle);
        
        $this->view->render('homepage/index.php');
        
    }
}

