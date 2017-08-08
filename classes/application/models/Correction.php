<?php
namespace application\models;

class Correction extends \core\Model
{
    /**
     * Имя таблицы заказов
     */
    public $tableName = 'corrections';
    
    /**
    * @var int  ID списания 
     */
    public $id = null;
    
    /**
     * @var int ID товара, который необходимо списать
     */
    public $id_goods = null;
    
    /**
     * @var int ID заказа
     */
    public $id_orders = null;
    
    /**
     * @var int Количество экземпляров товара
     */
    public $number = null;
    
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
    
    
    /**
     * Добавляет данные в таблицу БД
     */
    public function insert()
    {
        $sql = "INSERT INTO corrections (id_goods, number, id_orders) VALUES (:id_goods. :number, :id_orders)"; 
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_goods", $this->id_goods, \PDO::PARAM_INT );
        $st->bindValue( ":id_orders", $this->id_orders, \PDO::PARAM_INT );
        $st->bindValue( ":number", $this->number, \PDO::PARAM_INT );
        $st->execute();
        $this->id = $this->pdo->lastInsertId();
    }

    /**
    * Обновляем текущий объект заказа в базе данных
    */
    public function update()
    {
        $sql = "UPDATE $this->tableName SET id_goods=:id_goods, id_orders=:id_orders, number=:number WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_goods", $this->id_goods, \PDO::PARAM_INT );
        $st->bindValue( ":id_orders", $this->id_orders, \PDO::PARAM_INT );
        $st->bindValue( ":number", $this->number, \PDO::PARAM_INT );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }
    
}