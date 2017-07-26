<?php
namespace application\controllers;

/**
 * Класс для работы с ajax-запросами
 */
class AjaxController extends core\Controller
{
    /**
     * Подгрузка "лайков"
     */
    public function likesAction()
    {
        $newLikeCount = $_GET['likeCount'] + 1;
        //echo "Привет";
        echo $newLikeCount;
        //echo $_GET['id'];
    }
    
    
}

