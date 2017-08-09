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
        
        $viewOrder = $Order->getById($_POST['id']);
        
        $this->view->addVar('viewOrder', $viewOrder);
        
        $this->view->render('order/index.php');
        
    }
    
    public function manageAction() 
    {
        $Order = new Order();
        $newOrder = $Order->loadFromArray($_POST); 
//        \DebugPrinter::debug($newOrder);
//        \DebugPrinter::debug(!$newOrder->isUserOrder());
//        die();
        
        if (!$newOrder->isUserOrder()){
            $newOrder->insert();
            echo "Hello!";
            
        }
//        \DebugPrinter::debug($newOrder);
        
        $Correction = new Correction();
        $newCorrection = $Correction->loadFromArray($_POST);
        $id_orders = $Order->getUserOrderId();
        $newCorrection->id_orders = $id_orders;
//        \DebugPrinter::debug($newOrder);
//        \DebugPrinter::debug($id_orders);
//        \DebugPrinter::debug($newOrder->id);
//        die();
//        
        $newCorrection->goodOrderTransaction();
        \core\Session::get()->session['user']['order']++; // Увеличиваем счётчик коррекций
        $this->header(\Url::link("archive/allGoods"));
    }
    
}
