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
//        echo "Привет";
        $Article = new Article;
        $articleData = $Article->getById($_GET['id']);
        $articleData->likes++;
        $articleData->update();
        $result = json_encode($articleData->likes);
        echo $result;
        
        
//        $newLikeCount = $_GET['likeCount'] + 1;
//        echo $newLikeCount;
        //echo $_GET['id'];
    }
    
    
}

