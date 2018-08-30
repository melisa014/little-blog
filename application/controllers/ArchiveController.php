<?php
namespace application\controllers;
use \application\models\Article as Article;
use \application\models\Category as Category;
use \application\models\Adminusers as Adminusers;
use \application\models\Good as Good;

class ArchiveController extends \ItForFree\SimpleMVC\mvc\Controller
{
    /**
     * Список правил, ограничивающих доступ пользователей с разными ролями
     * @var type array
     */
    protected $rules = [
        ['allow' => true, 'roles' => ['@']],
    ];
    
    /**
     * Выводит на экран страницу "Архив"
     */
    public function indexAction()
    {
        $Article = new Article();
        $archiveArticles = $Article->getList();
        $archivePageTitle = "Архив";
        
        $this->view->addVar('archiveArticles', $archiveArticles);
        $this->view->addVar('archivePageTitle', $archivePageTitle);
        
        $this->view->render('archive/index.php');
        
    }  
    
    /**
     * Выводит на экран страницу "Архив. Категории" 
     */
    public function allCategoriesAction()
    {
        $Category = new Category();
        $archiveCategories = $Category->getList();
        $archivePageTitle = "Список категорий";
        
        $this->view->addVar('archiveCategories', $archiveCategories);
        $this->view->addVar('archivePageTitle', $archivePageTitle);
        
        $this->view->render('archive/allCategories.php');
        
    }
    
    /**
     * Выводит на экран страницу "Архив. Пользователи" 
     */
    public function allUsersAction()
    {
        $Adminusers = new Adminusers();
        $archiveAdminusers = $Adminusers->getList();
        $archivePageTitle = "Список пользователей";
        
        $this->view->addVar('archiveAdminusers', $archiveAdminusers);
        $this->view->addVar('archivePageTitle', $archivePageTitle);
        
        $this->view->render('archive/allUsers.php');
        
    }
    
    /**
     * Выводит на экран страницу "Архив. Товары" 
     */
    public function allGoodsAction()
    {
        $Good = new Good();
        $pageNumber = isset($_GET['pageNumber']) ? $_GET['pageNumber'] : 1;
        $limit = 3;
//        \DebugPrinter::debug($pageNumber);
        $archiveGood = $Good->getPage($pageNumber, $limit);
        $archivePageTitle = "Список товаров";
        
        $this->view->addVar('pageNumber', $pageNumber);
        $this->view->addVar('limit', $limit);
        $this->view->addVar('archiveGood', $archiveGood);
        $this->view->addVar('archivePageTitle', $archivePageTitle);
        
        $this->view->render('archive/allGoods.php');
        
    }
    
}

