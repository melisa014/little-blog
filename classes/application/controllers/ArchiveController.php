<?php
namespace application\controllers;
use \application\models\Article as Article;
use \application\models\Category as Category;

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
    
    /**
     * Выводит на экран страницу "Архив" Администратора 
     */
     public function indexAdminAction()
    {
        $Article = new Article();
        $archiveArticles = $Article->getList();
        
        
        $this->view->addVar('archiveArticles', $archiveArticles);
        $this->view->addVar('archivePageTitle', $this->archivePageTitle);
        
        $this->view->render('archive/indexAdmin.php');
        
    }
    
    
    /**
     * Выводит на экран страницу "Архив. Категории" Администратора 
     */
     public function allCategoriesAdminAction()
    {
        $Category = new Category();
        $archiveCategories = $Category->getList();
        $this->archivePageTitle = "Список категорий";
        
        
        $this->view->addVar('archiveCategories', $archiveCategories);
        $this->view->addVar('archivePageTitle', $this->archivePageTitle);
        
        $this->view->render('archive/allCategoriesAdmin.php');
        
    }
    
}

