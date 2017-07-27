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
         
        echo $Article->getLikes($_GET['id']);
    }
        
}

