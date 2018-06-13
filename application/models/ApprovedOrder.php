<?php
namespace application\models;

/**
 * Класс для работы с архивом заказов
 */
class ApprovedOrder extends \ItForFree\SimpleMVC\mvc\Model
{
    
    /**
     * Имя таблицы заказов
     */
    public $tableName = 'approve_orders';
    
    /**
    * @var int  ID заказа 
     */
    public $id = null;
    
    /**
     * @var int ID пользователя, сделавшего заказ
     */
    public $id_users = null;
    
    
    /**
    * Устанавливаем свойства с помощью значений в заданном массиве
    *
    * @param assoc Значения свойств
    */
    public function __construct( $data=array() ) 
    {
        parent::__construct();
        $this->set_object_vars($this, $data);
    }
    
    /**
    * Присваивает объекту свойства, соответствующие полям массива
    */
    private function set_object_vars($object, array $vars) 
    {
        $has = get_object_vars($object);
        foreach ($has as $name => $oldValue) {
            $object->$name = isset($vars[$name]) ? $vars[$name] : $object->$name; 
        }
    } 
    
    
}
