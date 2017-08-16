<?php
namespace application\controllers;
use \application\models\Good as Good;

/**
 * Класс для управления поиском товаров
 */
class GoodSearchController extends \core\mvc\Controller
{
    
    public function indexAction()
    {
        
        if(!empty($_GET['search'])) {
            $Good = new Good();
            $newGood = $Good->loadFromArray($_GET);
//                \DebugPrinter::debug($newGood);
//                die();
            $searchGood = $newGood->search(); // Возвращает двухэлементный массив, как и getList(), но подходящих критериям поиска товаров
//            \DebugPrinter::debug($searchGood, 'после поиска');
//                die();
            if ($searchGood){
                
                $searchPageTitle = "Поиск товаров";
          
                $this->view->addVar('searchGood', $searchGood);
                $this->view->addVar('searchPageTitle', $searchPageTitle);
                $this->view->render('good/search.php');
            } else {
                $this->header(\core\mvc\view\Url::link('goodSearch/index&total=ничего не найдено'));
            }
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
