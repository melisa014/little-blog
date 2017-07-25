<?php
namespace application\controllers;
use \application\models\Article as Article;
use \application\models\Category as Category;

class ArchiveController extends \core\Controller
{
    /**
     * Список правил, ограничивающих доступ пользователей с разными ролями
     * @var type array
     */
     protected $rules = [ //вариант 2:  здесь всё гибче, проще развивать в дальнешем
        'all' => ['allow' => ['admin', 'auth_user', 'guest']], // общее правило
        'allCategories' => ['deny' => ['guest']], //исключения
    ];
    
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
     * Выводит на экран страницу "Архив. Категории" Администратора 
     */
    public function allCategoriesAction()
    {
        $Category = new Category();
        $archiveCategories = $Category->getList();
        $this->archivePageTitle = "Список категорий";
        
        
        $this->view->addVar('archiveCategories', $archiveCategories);
        $this->view->addVar('archivePageTitle', $this->archivePageTitle);
        
        $this->view->render('archive/allCategories.php');
        
    }
    
}

