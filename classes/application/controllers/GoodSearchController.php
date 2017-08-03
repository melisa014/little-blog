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
        
            if(!empty($_GET['search'])) {
                $Good = new Good();
                $newGood = $Good->loadFromArray($_GET);
                \DebugPrinter::debug($newGood);
//                die();
                $goodsId = $newGood->search();
                \DebugPrinter::debug($goodsId, 'после поиска');
                die();
//                $this->header(\Url::link("good/search"));
            } 
        
        else {
            $Good = new Good();
            $searchGood = $Good->getList();
            $searchPageTitle = "Поиск товаров";

            $this->view->addVar('searchGood', $searchGood);
            $this->view->addVar('searchPageTitle', $searchPageTitle);

            $this->view->render('good/search.php');
        }
    }
    
}
