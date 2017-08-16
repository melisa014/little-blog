<?php
namespace application\controllers;

/**
 * Класс для работы с ajax-запросами
 */
class AjaxController extends \core\mvc\Controller 
{
    /**
     * Подгрузка "лайков" статей или товаров
     */
    public function likesAction()
    {
        $modelClassName = static::class;
        
        $Model = new $modelClassName();
        $Model->likesUpper($_GET['id'], $_GET['tableName']);
        \core\Session::get()->session['user']['userSessionLikesCount']++;
         
        echo $Model->getModelLikes($_GET['id'], $_GET['tableName']);
    }
    
    /**
     * Возвращает число понравившихся записей пользователя в данной сессии
     */
    public function sessionLikesCountAction()
    {
        echo \core\Session::get()->session['user']['userSessionLikesCount'];
    }
    
    /**
     * Поиск по товарам без перезагрузки страницы
     */
    public function searchGoodsAction()
    {
        
    }
    
    /**
     * Подгрузка "ленты" при прокрутке страницы 
     */
    public function showOnScrollingPageAction()
    {
        $Good = new \application\models\Good();
        
//        \DebugPrinter::debug($_POST);
//        \DebugPrinter::debug($_GET);
        
        $archiveGood = $Good->getPage($_POST['page-number'], $_POST['limit']); 
//        $archiveGood = $Good->getPage($_GET['page-number'], $_GET['limit']); 
        
//        \DebugPrinter::debug($archiveGood);
        $this->view->addVar('archiveGood', $archiveGood);
        
        $this->view->renderPartition('archive/allGoodsAjax.php');
    }
    
    /**
     * Добавление товара в корзину
    */
    public function addGoodToOrderAction()
    {
        $Order = new \application\models\Order();
        $Correction = new \application\models\Correction();
        $Good = new \application\models\Good();
        
        $newOrder = $Order->loadFromArray($_GET); 
//        \DebugPrinter::debug($_GET);
//        die();
        if($_GET['number'] <= $Good->getAvailableGoodById($_GET['id_goods'])){
            if (!$newOrder->isUserOrder()){
                $newOrder->insert();

            }
            $newCorrection = $Correction->loadFromArray($_GET);
            
            $id_orders = $Order->getUserOrderId();
            $newCorrection->id_orders = $id_orders;
//            \DebugPrinter::debug($newCorrection);
//        die();
            
            $newCorrection->updateGoodOrderTransaction();
            $result['goodsCount'] = $Correction->getUsersAllGoodsCount();
            $result['goodsAvaliable'] = $Good->getAvailableGoodById($_GET['id_goods']);
            $jsonResult = json_encode($result);
            echo $jsonResult;
        }
        else {
            $result['notAvaliable'] = "Недостаточно товаров на складе!";
            $jsonResult = json_encode($result);
            echo $jsonResult;
        }
    }
          
    /**
     * Добавление изображений к товару
     */
    public function addImageAction() 
    {
        
    }
    
    /**
     * Показать форму для добавления изображения
     */
    public function showFormToAddImageAction() 
    {
//        $imageIndex = $_GET['imageIndex'];
        
//        $this->view->addVar('imageIndex', $imageIndex);
        $this->view->renderPartition('good/addImageForm.php');
    }
    
    
}

