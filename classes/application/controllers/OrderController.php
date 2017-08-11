<?php
namespace application\controllers;
use \application\models\Order as Order;
use \application\models\Correction as Correction;
use \application\models\Good as Good;

/**
 *
 * @author qwegram
 */
class OrderController extends \core\Controller
{
    
    protected $rules = [
        'all' => ['allow' => ['admin', 'auth_user'], 'deny' => ['guest']]
    ];
            
    public function indexAction() 
    {
        $Order = new Order();
        $Correction = new Correction();
        $Good = new Good();
        
//        $viewOrder = $Order->getById($_POST['id'], orders);
        $userOrder = $Order->getUserOrderId(); // Получаем номер заказа данного пользователя
        $goodsInOrder = $Correction->getGoodsIdByOrderId($userOrder); // Получаем все ID товаров, зафиксированных в данном заказе
//        \DebugPrinter::debug($goodsInOrder);
        foreach ($goodsInOrder as $goodId) {
//            \DebugPrinter::debug($goodId);
             $viewOrder[] = $Good->getById($goodId['id_goods'], 'goods');
//             $usersGoodsCount[] = $Correction->getUsersGoodsCount($goodId['id_goods']);
        }
//        \DebugPrinter::debug($usersGoodsCount);
//        die();
        
        $orderTitle = "Ваш заказ";
        
        $this->view->addVar('viewOrder', $viewOrder);
        $this->view->addVar('usersGoodsCount', $usersGoodsCount);
        $this->view->addVar('orderTitle', $orderTitle);
        
        $this->view->render('order/index.php');
        
    }
    
    public function manageAction() 
    {
        $Order = new Order();
        $newOrder = $Order->loadFromArray($_POST); 
        
        if (!$newOrder->isUserOrder()){
            $newOrder->insert();
                       
        }
        
        $Correction = new Correction();
        $newCorrection = $Correction->loadFromArray($_POST);
        $id_orders = $Order->getUserOrderId();
        $newCorrection->id_orders = $id_orders;
//        
        $newCorrection->updateGoodOrderTransaction();
        \core\Session::get()->session['user']['order']++; // Увеличиваем счётчик коррекций
        $this->header(\Url::link("archive/allGoods"));
    }
    
}
