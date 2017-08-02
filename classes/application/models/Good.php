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
//         Есть уже у объекта Good ID?
//        if ( !is_null( $this->id ) ) trigger_error ( "Good::insert(): Attempt to insert an Good object that already has its ID property set (to $this->id).", E_USER_ERROR );

        // Вставляем статью
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
    * Обновляем текущий объект статьи в базе данных
    */
    public function update()
    {
        // Есть ли у объекта Good ID?
//        if ( is_null( $this->id ) ) trigger_error ( "Good::update(): Attempt to update an Good object that does not have its ID property set.", E_USER_ERROR );

        // Обновляем статью
        $sql = "UPDATE $this->tableName SET description=:description, price=:price, name=:name, available=:available, likes=:likes, likes=:likes WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":description", $this->description, \PDO::PARAM_STR );
        $st->bindValue( ":price", $this->price, \PDO::PARAM_INT );
        $st->bindValue( ":name", $this->name, \PDO::PARAM_STR );
        $st->bindValue( ":available", $this->available, \PDO::PARAM_INT );
        $st->bindValue( ":likes", $this->likes, \PDO::PARAM_INT );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
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