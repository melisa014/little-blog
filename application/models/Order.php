<?php
namespace application\models;
use ItForFree\SimpleMVC\Config;

class Order extends BaseExampleModel
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
     * Для хранения объекта текущего пользоватея
     * @var object 
     */
    public $User = null;
    
    
    /**
    * Устанавливаем свойства с помощью значений в заданном массиве
    *
    * @param assoc Значения свойств
    */
    public function __construct( $data=array() ) 
    {
        parent::__construct();
        $this->set_object_vars($this, $data);
        $this->User = Config::getObject('core.user.class');
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
     * Добавляет данные в таблицу БД (ПРОДУБЛИРОВАННА В ТРАНЗАКЦИИ $Correction->updateGoodOrderTransaction())
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
     * Получает Id заказа по id пользователя
     * @return type integer 
     */
    public function getUserOrderId()
    {
        $sql = "SELECT id FROM $this->tableName WHERE id_users = :id_users ";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_users",  $this->User->getId(), \PDO::PARAM_INT );
        $st->execute();
        $id = $st->fetch();
        return $id['id'];
    }
    
    public function isUserOrder()
    {
        $sql = "SELECT id FROM $this->tableName WHERE id_users = :id_users ";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_users", $this->User->getId(), \PDO::PARAM_INT );
        $st->execute();
        $id = $st->fetch();
//        \DebugPrinter::debug($id);
//        die();
        if (!empty($id)) return true;
        else return false;
    }
    
    /**
     * Закрывает заказ при подтверждении пользователем
     */
    public function closeUserOrder() 
    {
        $sql = "DELETE FROM $this->tableName WHERE id_users = :id_users ";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_users", $this->User->getId(), \PDO::PARAM_INT );
        $st->execute();
    }
    
}

