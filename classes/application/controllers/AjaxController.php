<?php
namespace application\controllers;
use \application\models\Article as Article;

/**
 * Класс для работы с ajax-запросами
 */
class AjaxController extends \core\Controller 
{
    /**
     * Подгрузка "лайков"
     */
    public function likesAction()
    {
        $Article = new Article;
        $Article->likesUpper($_GET['id']);
        \core\Session::get()->session['user']['userSessionLikesCount']++;
         
        echo $Article->getArticleLikes($_GET['id']);
    }
    
    public function sessionLikesCountAction()
    {
        echo \core\Session::get()->session['user']['userSessionLikesCount'];
    }
        
}

