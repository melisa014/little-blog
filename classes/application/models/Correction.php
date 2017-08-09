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
    
    
    /**
     * Добавляет данные в таблицу БД
     */
    public function insert()
    {
        
        $sql = "INSERT INTO $this->tableName SET id_goods=:id_goods, number=:number, id_orders=:id_orders 
                    ON DUPLICATE KEY UPDATE number = number + :number";
//        $sql = "INSERT INTO $this->tableName (id_goods, number, id_orders) VALUES (:id_goods, :number, :id_orders)"; 
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_goods", $this->id_goods, \PDO::PARAM_INT );
        $st->bindValue( ":id_orders", $this->id_orders, \PDO::PARAM_INT );
        $st->bindValue( ":number", $this->number, \PDO::PARAM_INT );
        $st->execute();
        $this->id = $this->pdo->lastInsertId();
    }

    /**
     * Транзакция полной покупки товара
     */
    public function goodOrderTransaction()
    {
        $sql = "BEGIN;"
                . "INSERT INTO orders (id_users) VALUES (:id_users);"
//                . "SAVE TRANSACTION StartOrder;"
                . "INSERT INTO corrections SET id_goods=:id_goods, number=:number, id_orders=:id_orders 
                    ON DUPLICATE KEY UPDATE number = number + :number;"
//                . "IF @@ERROR <> 0 ROLLBACK TRANSACTION StartOrder;"
                . "UPDATE goods SET reserve = reserve + :number, available = available - :number WHERE id = :id_goods;"
//                . "IF @@ERROR <> 0 ROLLBACK TRANSACTION StartOrder;"
                . "COMMIT";
        $st = $this->pdo->prepare ( $sql );
        
        $st->bindValue( ":id_users", $this->id_users, \PDO::PARAM_INT );
        
        $st->bindValue( ":id_goods", $this->id_goods, \PDO::PARAM_INT );
        $st->bindValue( ":id_orders", $this->id_orders, \PDO::PARAM_INT );
        $st->bindValue( ":number", $this->number, \PDO::PARAM_INT );
        
        $st->execute();
        
    }
    
    /**
     * Транзакция полной покупки товара (добавление)
     */
    public function updateGoodOrderTransaction()
    {
        $sql = "BEGIN;"
                . "INSERT INTO corrections SET id_goods=:id_goods, number=:number, id_orders=:id_orders 
                    ON DUPLICATE KEY UPDATE number = number + :number;"
//                . "SAVE TRANSACTION StartOrder;"
                . "UPDATE goods SET reserve = reserve + :number, available = available - :number WHERE id = :id_goods;"
//                . "IF @@ERROR <> 0 ROLLBACK TRANSACTION StartOrder;"
                . "COMMIT";
        $st = $this->pdo->prepare ( $sql );
        
        $st->bindValue( ":id_users", $this->id_users, \PDO::PARAM_INT );
        
        $st->bindValue( ":id_goods", $this->id_goods, \PDO::PARAM_INT );
        $st->bindValue( ":id_orders", $this->id_orders, \PDO::PARAM_INT );
        $st->bindValue( ":number", $this->number, \PDO::PARAM_INT );
        
        $st->execute();
        
    }
    
}