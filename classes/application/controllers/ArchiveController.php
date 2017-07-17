<?php
namespace application\controllers;
use \application\models\Article as Article;

class ArchiveController extends \core\Controller
{
    public $archivePageTitle = "Архив";
    
    /**
     * 
     */
        public function run()
    {
        
        $archiveArticles = Article::getList(); //"Здесь должны быть все статьи, когда-либо созданные"
        
        
        $this->view->addVar('archiveArticles', $archiveArticles);
        $this->view->addVar('archivePageTitle', $this->archivePageTitle);
        
        $this->view->render('archive/index.php');
        
    }
}

