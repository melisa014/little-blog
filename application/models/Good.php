<?php
namespace application\models;

class Good extends \ItForFree\SimpleMVC\mvc\Model
{
    /**
     * @var string Имя обрабатываемой таблицы 
     */
    public $tableName = 'goods';
    
    /**
     * @var string Критерий сортировки строк таблицы
     */
    public $orderBy = 'id';
    
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
     * @array Массив описаний прикрепляемых изображений
     */
    public $imageDescription = [];

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
        $sql = "UPDATE $this->tableName SET description=:description, price=:price, name=:name, available=:available, likes=:likes WHERE id = :id";  
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
    * return array Возвращает массив объектов - товаров, соответствующих условиям, заданным пользователем
    */
    public function search()
    {
        $sql = "SELECT * FROM $this->tableName WHERE";
        
        $whereOptions = [
            'price_from' => [
                'sql' => "price >= :price_from",
                'type' => \PDO::PARAM_INT],
            'price_to' => [
                'sql' => "price <= :price_to",
                'type' => \PDO::PARAM_INT],
            'name' => [
                'sql' => "name LIKE :name",
                'type' => \PDO::PARAM_STR,
                'wrap' => "%"],
            'available' => [
                'sql' => "available >= :available",
                'type' => \PDO::PARAM_INT]
            
        ];
        
        foreach ($_GET as $key => $value) { // Составляем массив из параметров WHERE (в зависимости от того, что ввёл пользователь)
            if (!empty($_GET[$key])) {
                if (isset($whereOptions[$key])){
                    $sql_arr[] = $whereOptions[$key]['sql'];
                }
            }
        }
//        \DebugPrinter::debug($sql_arr);
//        die();
        if (!empty($sql_arr)) {
            $sql_str = implode(' AND ', $sql_arr); // Составляем строку из параметров WHERE
            $sql .= " ". $sql_str . " ORDER BY likes"; // Собираем SQL-запрос
//            \DebugPrinter::debug($sql);
//            die();
            echo "<br>";
            $st = $this->pdo->prepare ( $sql );

            foreach ($_GET as $key => $value) { // Подставляем в подготовленный запрос значения на места переменных
                if (!empty($_GET[$key]) 
                        && isset($whereOptions[$key])) {
//                    \DebugPrinter::debug($_GET[$key]);
//                    \DebugPrinter::debug($whereOptions[$key]);
//                    die();
                    if (!empty($whereOptions[$key]['wrap'])) {
                        $st->bindValue(":" . $key, $whereOptions[$key]['wrap'] . $this->$key . $whereOptions[$key]['wrap'], $whereOptions[$key]['type']);
                    } else {
                        $st->bindValue(":" . $key, $this->$key, $whereOptions[$key]['type']);
                    }
                }
            }
            $st->execute(); // Выполняем SQL-запрос

            while ( $row = $st->fetch() ) { // Заполняем массив $list объектами товаров
                $example = new Good( $row );
                $list[] = $example;
            }
    //        \DebugPrinter::debug($list);
    //        die();
            $totalRows = count($list);
            if ($totalRows !== 0) {
                return (array ("results" => $list, "totalRows" => $totalRows));
            } else return false;
        }
        else return false;
    }
    
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
    
    /**
     * Возвращает число товаров с данным Id, находящихся в наличии
     */
    public function getAvailableGoodById($goodId)
    {
        $sql = "SELECT available FROM $this->tableName WHERE id = :goodId ";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":goodId", $goodId, \PDO::PARAM_INT );
        $st->execute();
        $available = $st->fetch();
        return $available['available'];
    }
    
    /**
     * Снимает резерв данного товара, заказанный данным пользователем (при отмене заказа)
     */
    public function closeUserGoodReserve($goodId)
    {
        $sql = "UPDATE $this->tableName SET reserve = reserve - :reserve, available = available + :reserve WHERE id = :id";
       
        $Correction = new Correction();
        $reserve = $Correction->getUsersGoodCount($goodId);
//        \DebugPrinter::debug($reserve);
//        die();
        
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":reserve", $reserve['number'], \PDO::PARAM_INT );
        $st->bindValue( ":id", $goodId, \PDO::PARAM_INT );
        $st->execute();
    }
    
    /**
     * Списывает резерв данного товара, заказанный данным пользователем (при подтверждении заказа)
     */
    public function approveUserGoodReserve($goodId)
    {
        $sql = "UPDATE $this->tableName SET reserve = reserve - :reserve WHERE id = :id";
       
        $Correction = new Correction();
        $reserve = $Correction->getUsersGoodCount($goodId);
        
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":reserve", $reserve['number'], \PDO::PARAM_INT );
        $st->bindValue( ":id", $goodId, \PDO::PARAM_INT );
        $st->execute();
    }
    
    
    /**
     * 
     */
    public function approveUserOrder()
    {
        
    }

    
}