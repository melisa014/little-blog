<?php
namespace application\controllers;
use \application\models\Article as Article;

class ArchiveController extends \core\Controller
{
    /**
     * @var string Название страницы
     */
    public $archivePageTitle = "Архив";
    
    /**
     * Выводит на экран страницу "Архив"
     */
    public function indexAction()
    {
        $Article = new Article();
        $archiveArticles = $Article->getList();
        
        
        $this->view->addVar('archiveArticles', $archiveArticles);
        $this->view->addVar('archivePageTitle', $this->archivePageTitle);
        
        $this->view->render('archive/index.php');
        
    }
    
}

