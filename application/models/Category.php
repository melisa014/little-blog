<?php
namespace application\models;

class Category extends \core\mvc\Model
{
    /**
     * @var string Имя обрабатываемой таблицы 
     */
    public $tableName = 'categories';
    
    /**
     * @var string Критерий сортировки строк таблицы
     */
    public $orderBy = 'name ASC';
    
    /**
    * @var int ID категории из базы данны
    */
    public $id = null;

    /**
    * @var string Название категории
    */
    public $name = null;

    /**
    * @var string Описание категории
    */
    public $description = null;
            

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
//         Есть уже у объекта Article ID?
//        if ( !is_null( $this->id ) ) trigger_error ( "Article::insert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );

        // Вставляем статью
        $sql = "INSERT INTO $this->tableName ( name, description ) VALUES ( :name, :description )";
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":name", $this->name, \PDO::PARAM_STR );
        $st->bindValue( ":description", $this->description, \PDO::PARAM_STR );
        
        $st->execute();
        $this->id = $this->pdo->lastInsertId();
    }

    /**
    * Обновляем текущий объект статьи в базе данных
    */
    public function update()
    {
        // Есть ли у объекта статьи ID?
//        if ( is_null( $this->id ) ) trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );

        // Обновляем статью
        $sql = "UPDATE $this->tableName SET name=:name, description=:description WHERE id = :id";
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":name", $this->name, \PDO::PARAM_STR );
        $st->bindValue( ":description", $this->description, \PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }

    public function articleUpdate()
    {
        $sql = "UPDATE $this->tableName SET publicationDate=:publicationDate, categoryId=:categoryId, title=:title, summary=:summary, content=:content, likes=:likes WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":publicationDate", (new \DateTime('NOW'))->format('Y-m-d H:i:s'), \PDO::PARAM_INT );
        $st->bindValue( ":categoryId", $this->categoryId, \PDO::PARAM_INT );
        $st->bindValue( ":title", $this->title, \PDO::PARAM_STR );
        $st->bindValue( ":summary", $this->summary, \PDO::PARAM_STR );
        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->bindValue( ":likes", $this->likes, \PDO::PARAM_INT );
        $st->execute();
    }
}


