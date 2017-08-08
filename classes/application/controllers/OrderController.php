<?php
namespace application\controllers;
use \application\models\Order as Order;
use \application\models\Correction as Correction;

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
//        \DebugPrinter::debug(\core\Session::get()->session['user']['order']);
        $Order = new Order();
        $Correction = new Correction();
        $newOrder = $Order->loadFromArray($_POST);
        $newCorrection = $Correction->loadFromArray($_POST);
//        \DebugPrinter::debug($newOrder);
        if (!empty(\core\Session::get()->session['user']['order'])) {
            $newOrder->update();
            
            $id_orders = $Order->getUserOrderId();
//            \DebugPrinter::debug($newCorrection);
            $newCorrection->id_orders = $id_orders;
//            \DebugPrinter::debug($newCorrection);
//            die();
            $newCorrection->update();
            
            \core\Session::get()->session['user']['order']++;
            $this->header(\Url::link("archive/allGoods"));
        }
        else {
            $newOrder->insert();
            
            $id_orders = $Order->getUserOrderId();
//            \DebugPrinter::debug($newCorrection);
            $newCorrection->id_orders = $id_orders;
//            \DebugPrinter::debug($newCorrection);
//            die();
            $newCorrection->insert();
            
            \core\Session::get()->session['user']['order'] = 1;
            $this->header(\Url::link("archive/allGoods"));
        }
    }
    
}
