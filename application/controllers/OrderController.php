<?php
namespace application\controllers;
use \application\models\Order as Order;
use \application\models\Correction as Correction;
use \application\models\Good as Good;
use \application\models\ApprovedOrder as ApprovedOrder;

/**
 *
 * @author qwegram
 */
class OrderController extends \ItForFree\SimpleMVC\mvc\Controller
{
    
    protected $rules = [
        'all' => ['allow' => ['admin', 'auth_user'], 'deny' => ['guest']]
    ];
            
    public function indexAction() 
    {
        $Order = new Order();
        $Correction = new Correction();
        $Good = new Good();
        $ApprovedOrder = new ApprovedOrder();

        if (!empty($_POST)){
            if (!empty($_POST['approveOrder'])) { // Подтверждаем заказ
                \ItForFree\SimpleMVC\DebugPrinter::debug($_POST);
                die('Здесь нужно дописать сохранение подтверждённого заказа в БД, таблицу approve_orders');
                // Здесь еужно дописать сохранение подтверждённого заказа в БД, таблицу approve_orders
                
                $newGood = $Good->loadFromArray($_POST);
                $ApprovedOrder->insert();
                $goodsId = $Correction->getGoodsIdByOrderId(); // получаем массив Id товаров, которые заказывал пользователь
                foreach ($goodsId as $goodId) {
                   $reserve = $Correction->getUsersGoodCount($goodId['id_goods']); // получаем значение резерва, который нужно списать
                   $Good->approveUserGoodReserve($goodId['id_goods']);
                }
            
                $Order->closeUserOrder();
                $this->header(\ItForFree\SimpleMVC\Url::link("order/index"));
            }
            if (!empty($_POST['closeOrder'])) { // Отменяем заказ
                $goodsId = $Correction->getGoodsIdByOrderId(); // получаем массив Id товаров, которые заказывал пользователь
                foreach ($goodsId as $goodId) {
//                   $reserve = $Correction->getUsersGoodCount($goodId['id_goods']); // получаем значение резерва, который нужно списать
                   $Good->closeUserGoodReserve($goodId['id_goods']);
                }
            
                $Order->closeUserOrder();
                $this->header(\ItForFree\SimpleMVC\Url::link("order/index"));
            }
            
        }
        else {
            $goodsInOrder = $Correction->getGoodsIdByOrderId(); // Получаем все ID товаров, зафиксированных в данном заказе
    //        \DebugPrinter::debug($goodsInOrder);
            foreach ($goodsInOrder as $goodId) {
    //            \DebugPrinter::debug($goodId);
                 $viewOrder[] = $Good->getById($goodId['id_goods'], 'goods');
            }

            $orderTitle = "Ваш заказ";

            $this->view->addVar('viewOrder', $viewOrder);
            $this->view->addVar('orderTitle', $orderTitle);

            $this->view->render('order/index.php');
        
        }
        
    }
    
    public function deleteGoodAction()
    {
        $Order = new Order();
        $Correction = new Correction();
        $Good = new Good();
        if(!empty($_POST['deleteFromOrder'])){
            $Good->closeUserGoodReserve($_POST['goodId']); // Снимаем товары с резерва
            $Correction->deleteGoodCorrectionById($_POST['goodId']); // Удаляем коррекцию только данного товара
            $goodsInOrder = $Correction->getGoodsIdByOrderId(); // Получаем все ID товаров, зафиксированных в данном заказе
    //                \DebugPrinter::debug($goodsInOrder);
            if (empty($goodsInOrder)) {
                $Order->closeUserOrder();
            }
            $this->header(\ItForFree\SimpleMVC\Url::link("order/index"));
        } 
    }
    
    public function approveAction()
    {
        if (!empty($_POST)) {
            
            if (!empty($_POST['approveOrder'])) {
                
                
                
                
                $this->header(\ItForFree\SimpleMVC\Url::link("archive/allGoods"));
              
            }
        }
    }
}
