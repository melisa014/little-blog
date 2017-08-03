<?php
namespace application\models;

class Good extends \core\Model
{
    /**
     * @var string Имя обрабатываемой таблицы 
     */
    public $tableName = 'goods';
    
    /**
     * @var string Критерий сортировки строк таблицы
     */
    public $orderBy = 'likes DESC';
    
    /**
    * @var int ID из базы данны
    */
    public $id = null;

    /**
    * @var string Описание товара
    */
    public $description = null;

    /**
    * @var string Полное название товара
    */
    public $name = null;

     /**
    * @var int В наличии на складе
    */
    public $available = null;

    /**
    * @var int Цена товара
    */
    public $price = null;
    
    /**
    * @var int Цена товара
    */
    public $price_from = null;
    
    /**
    * @var int Цена товара
    */
    public $price_to = null;

    /**
    * @var int Количество лайков)
    */
    public $likes = null;
            

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
        $sql = "INSERT INTO $this->tableName (description, price, name, available, likes) VALUES ( :description, :price, :name, :available, :likes)"; 
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":description", $this->description, \PDO::PARAM_STR );
        $st->bindValue( ":price", $this->price, \PDO::PARAM_INT );
        $st->bindValue( ":name", $this->name, \PDO::PARAM_STR );
        $st->bindValue( ":available", $this->available, \PDO::PARAM_INT );
        $st->bindValue( ":likes", 0, \PDO::PARAM_INT );
        $st->execute();
        $this->id = $this->pdo->lastInsertId();
//        \DebugPrinter::debug($this);
    }

    /**
    * Обновляем текущий объект товара в базе данных
    */
    public function update()
    {
        $sql = "UPDATE $this->tableName SET description=:description, price=:price, name=:name, available=:available, likes=:likes, WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":description", $this->description, \PDO::PARAM_STR );
        $st->bindValue( ":price", $this->price, \PDO::PARAM_INT );
        $st->bindValue( ":name", $this->name, \PDO::PARAM_STR );
        $st->bindValue( ":available", $this->available, \PDO::PARAM_INT );
        $st->bindValue( ":likes", $this->likes, \PDO::PARAM_INT );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }
    
     /**
    * Ищем товар в базе данных
    * return array Возвращает массив Id элементов, соответствующих условиям, заданным пользователем
    */
    public function search()
    {
        $sql = "SELECT id FROM $this->tableName WHERE";
        
        $whereOptions = [
            'price_from' => [
                'sql' => "price >= :price_from",
                'type' => \PDO::PARAM_INT],
            'price_to' => [
                'sql' => "price <= :price_to",
                'type' => \PDO::PARAM_INT],
            'name' => [
                'sql' => "name = :name",
                'type' => \PDO::PARAM_STR],
            'available' => [
                'sql' => "available >= :available",
                'type' => \PDO::PARAM_INT]
            
        ];
        
//        \DebugPrinter::debug($_GET);
//        die();
        foreach ($_GET as $key => $value) { // Составляем массив из параметров WHERE (в зависимости от того, что ввёл пользователь)
            if (isset($whereOptions[$key])){
                $sql_arr[] = $whereOptions[$key]['sql'];
            }
        }
        
        $sql_str = implode(' AND ', $sql_arr); // Составляем строку из параметров WHERE
//        \DebugPrinter::debug($sql_str);
//        die();
        $sql .= " ". $sql_str . " ORDER BY likes"; // Собираем SQL-запрос
        \DebugPrinter::debug($sql);
        echo "<br><br>";
//        die();
        $st = $this->pdo->prepare ( $sql );
        
        foreach ($_GET as $key => $value) {
            if (isset($whereOptions[$key])) {
                echo ":" . $key, $this->$key, $whereOptions[$key]['type'] . "<br>";
                $st->bindValue(":" . $key, $this->$key, $whereOptions[$key]['type']);
            }
        }
        
        $st->execute();
        $result = $st->fetchAll();
        \DebugPrinter::debug($result);
        die();
        return $result;
        
    }
    
//    
//        public function likesUpper($id)
//    {
//        $goodData = $this->getById($id);
//        $goodData->likes++;
//        $goodData->update();
//    }
//    
//    public function getGoodLikes($id)
//    {
//        $goodData = $this->getById($id);
//        return $goodData->likes;
//    }
}