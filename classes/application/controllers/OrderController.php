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

        if (!empty($_POST)){
            if (!empty($_POST['approveOrder'])) { // Подтверждаем заказ
                $goodsId = $Correction->getGoodsIdByOrderId(); // получаем массив Id товаров, которые заказывал пользователь
                foreach ($goodsId as $goodId) {
                   $reserve = $Correction->getUsersGoodCount($goodId['id_goods']); // получаем значение резерва, который нужно списать
                   $Good->approveUserGoodReserve($goodId['id_goods']);
                }
            
                $Order->closeUserOrder();
                $this->header(\Url::link("order/index"));
            }
            if (!empty($_POST['closeOrder'])) { // Отменяем заказ
                $goodsId = $Correction->getGoodsIdByOrderId(); // получаем массив Id товаров, которые заказывал пользователь
                foreach ($goodsId as $goodId) {
//                   $reserve = $Correction->getUsersGoodCount($goodId['id_goods']); // получаем значение резерва, который нужно списать
                   $Good->closeUserGoodReserve($goodId['id_goods']);
                }
            
                $Order->closeUserOrder();
                $this->header(\Url::link("order/index"));
            }
            if(!empty($_POST['deleteFromOrder'])){
                $Good->closeUserGoodReserve($_POST['goodId']);
                if ($Correction->getUsersAllGoodsCount() <= 0) {
                    $Order->closeUserOrder();
                }
                $this->header(\Url::link("order/index"));
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
    
    public function manageAction() 
    {
        $Order = new Order();
        $Correction = new Correction();
        $Good = new Good();
        
        $newOrder = $Order->loadFromArray($_POST); 
        

        if($_POST['number'] <= $Good->getAvailableGoodById($_POST['id_goods'])){
            if (!$newOrder->isUserOrder()){
                $newOrder->insert();

            }
            $newCorrection = $Correction->loadFromArray($_POST);
            $id_orders = $Order->getUserOrderId();
            $newCorrection->id_orders = $id_orders;
    //        
            $newCorrection->updateGoodOrderTransaction();
            $this->header(\Url::link("archive/allGoods"));
        }
        else echo "Недостаточно товаров на складе!";
            
    }
    
}
