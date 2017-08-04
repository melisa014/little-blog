<?php
namespace application\controllers;

/**
 * Класс для работы с ajax-запросами
 */
class AjaxController extends \core\Controller 
{
    /**
     * Подгрузка "лайков" статей или товаров
     */
    public function likesAction()
    {
        $modelClassName = static::class;
        
        $Model = new $modelClassName();
        $Model->likesUpper($_GET['id'], $_GET['tableName']);
        \core\Session::get()->session['user']['userSessionLikesCount']++;
         
        echo $Model->getModelLikes($_GET['id'], $_GET['tableName']);
    }
    
    public function sessionLikesCountAction()
    {
        echo \core\Session::get()->session['user']['userSessionLikesCount'];
    }
    
    public function searchGoods()
    {
        
    }
    
    public function ()
    {
        
    }
          
}

