<?php
namespace application\controllers;
use \application\models\Good as Good;

/**
 * Класс для управления поиском товаров
 * @author qwegram
 */
class GoodSearchController extends \core\Controller
{
    
    public function indexAction()
    {
        $Good = new Good();
        $searchGood = $Good->getList();
        $searchPageTitle = "Поиск товаров";
        
        $this->view->addVar('searchGood', $searchGood);
        $this->view->addVar('searchPageTitle', $searchPageTitle);
        
        $this->view->render('good/search.php');
    }
    
}
