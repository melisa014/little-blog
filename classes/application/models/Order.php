<?php
namespace application\models;

class Order extends \core\Model
{
    /**
     * Имя таблицы заказов
     */
    public $tableName = 'orders';
    
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
    
    
    /**
     * Добавляет данные в таблицу БД
     */
    public function insert()
    {
        $sql = "INSERT INTO $this->tableName (id_users) VALUES (:id_users)"; 
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_users", $this->id_users, \PDO::PARAM_INT );
        $st->execute();
        $this->id = $this->pdo->lastInsertId();
//        \DebugPrinter::debug($this);
        
    }

    /**
    * Обновляем текущий объект заказа в базе данных
    */
    public function update()
    {
        $sql = "UPDATE $this->tableName SET id_users=:id_users WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_users", $this->id_users, \PDO::PARAM_INT );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }
    
    public function getUserOrderId()
    {
        $sql = "SELECT id FROM $this->tableName WHERE id_users = :id_users ";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_users", (new \core\Model)->getUserId(), \PDO::PARAM_INT );
        $st->execute();
        $id = $st->fetch();
        return $id['id'];
    }
    
}

