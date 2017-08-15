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
     * Добавляет данные в таблицу БД (ПРОДУБЛИРОВАННА В ТРАНЗАКЦИИ $Correction->updateGoodOrderTransaction())
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
     * Транзакция полной покупки товара (добавление)
     */
    public function updateGoodOrderTransaction()
    {
        $sql = "START TRANSACTION;"
                . "INSERT INTO corrections SET id_goods=:id_goods, number=:number, id_orders=:id_orders 
                    ON DUPLICATE KEY UPDATE number = number + :number;"
                . "UPDATE  goods SET reserve = reserve + :number, available = available - :number WHERE id = :id_goods;"
                . "COMMIT";
        $st = $this->pdo->prepare ( $sql );
        
        $st->bindValue( ":id_users", $this->id_users, \PDO::PARAM_INT );
        
        $st->bindValue( ":id_goods", $this->id_goods, \PDO::PARAM_INT );
        $st->bindValue( ":id_orders", $this->id_orders, \PDO::PARAM_INT );
        $st->bindValue( ":number", $this->number, \PDO::PARAM_INT );
        
        $st->execute();
        
    }
    
    /**
     * Возвращает id товаров, найденных в данном заказе
     */
    public function getGoodsIdByOrderId()
    {
        $sql = "SELECT id_goods FROM $this->tableName WHERE id_orders = :id_orders ";  
        
        $orderId = (new Order())->getUserOrderId();
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_orders", $orderId, \PDO::PARAM_INT );
        $st->execute();
        $goodsId = $st->fetchAll();
//        \DebugPrinter::debug($id);
//        die();
        return $goodsId;
    }
    
    /**
     * Возвращает количество данного товара, заказанного пользователем
     * @param type $goodId
     */
    public function getUsersGoodCount($goodId)
    {
        $sql = "SELECT number FROM $this->tableName WHERE id_goods = :id_goods AND id_orders = :id_orders ";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_goods", $goodId, \PDO::PARAM_INT );
        $st->bindValue( ":id_orders", (new \application\models\Order())->getUserOrderId(), \PDO::PARAM_INT );
        $st->execute();
        $goodsCount = $st->fetch();
//        \DebugPrinter::debug($goodsCount);
//        die();
        return $goodsCount;
    }

    /**
     * Возвращает количество наименований товаров, заказанных пользователем
     */
    public function getUsersAllGoodsCount()
    {
        $goodsCountArray = $this->getGoodsIdByOrderId();
        return count($goodsCountArray);
            
    }       
    
    /**
     * Возвращает число товаров в наличии по ID
     */
    public function getAvailableGoodsById($goodId)
    {
        $sql = "SELECT available FROM $this->tableName WHERE id_goods = :id_goods";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_goods", $goodId, \PDO::PARAM_INT );
        $st->execute();
        $goodsCount = $st->fetch();
//        \DebugPrinter::debug($goodsCount);
//        die();
        return $goodsCount;
    }
}