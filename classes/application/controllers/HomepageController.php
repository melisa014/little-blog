<?php
namespace application\controllers;
use \application\models\Article as Article;
use \application\models\Category as Category;

class HomepageController extends \core\Controller
{
    /**
     * @var string Название страницы
     */
    public $homepageTitle = "Домашняя страница";
    
    protected $rules = [];
    
    /**
     * Выводит на экран страницу "Домашняя страница"
     */
    public function indexAction()
    {
        $Article = new Article();
        $Category = new Category();
        $homepageArticles = $Article->getList();
        $homepageCategories = $Category->getList();
        
        $this->view->addVar('homepageArticles', $homepageArticles);
        $this->view->addVar('homepageCategories', $homepageCategories);
        $this->view->addVar('homepageTitle', $this->homepageTitle);
        
        $this->view->render('homepage/index.php');
        
        
    }
    
   
}

