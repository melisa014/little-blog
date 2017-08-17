<?php

namespace application\models;

/**
 * Класс для загрузки файлов 
 */
class Image extends \core\mvc\Model
{
    /**
     * @var string Имя обрабатываемой таблицы 
     */
    public $tableName = 'images';
    
    /**
     * @var string Критерий сортировки строк таблицы
     */
    public $orderBy = 'id';
    
    /**
    * @var int ID из базы данных
    */
    public $id = null;

    /**
    * @var string Описание изображения
    */
    public $imageDescription = null;

    /**
    * @var string Относитльный путь к файлу на сервере
    */
    public $path = null;

     /**
    * @var int Id товара, к которому относятся изображения
    */
    public $id_goods = null;

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
        foreach ($this->imageDescription as $key => $description){
            $sql = "INSERT INTO $this->tableName (description, path, id_goods) VALUES ( :description, :path, :id_goods)"; 
            $st = $this->pdo->prepare ( $sql );
            $st->bindValue( ":description", $description, \PDO::PARAM_STR );
            $st->bindValue( ":path", $this->path[$key], \PDO::PARAM_STR );
            $st->bindValue( ":id_goods", $this->id_goods, \PDO::PARAM_INT );
            $st->execute();
            $this->id = $this->pdo->lastInsertId();
    //        \DebugPrinter::debug($this);
        }
        
    }
    
    /**
    * Обновляем текущий объект изображения в базе данных
    */
    public function update()
    {
        $sql = "UPDATE $this->tableName SET description=:description, path=:path, id_goods=:id_goods WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":description", $this->description, \PDO::PARAM_STR );
        $st->bindValue( ":path", $this->path, \PDO::PARAM_STR );
        $st->bindValue( ":id_goods", $this->id_goods, \PDO::PARAM_INT );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }
    
    /**
     * 
     */
    public function getImagesPathByGoodId($goodId) 
    {
        $sql = "SELECT path FROM $this->tableName WHERE id_goods=:id_goods"; 
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":id_goods", $goodId, \PDO::PARAM_INT );
        $st->execute();
        $path = $st->fetchAll();
//        \core\DebugPrinter::debug($path);
//        die();
        return $path;
    }
}
