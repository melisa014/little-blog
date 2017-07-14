<?php
namespace application\controllers;
//use \controllers\HomepageController as HomepageController;


class HomepageController extends \core\Controller
{
    /**
     * 
     */
    public function run()
    {
 
        $text = "Hello! I'm Homepage! Method run() is launched...";
        $this->view->addVar('text', $text);
        
        $this->view->render('homepage/index.php');
        
    }
}

