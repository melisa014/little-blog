<?php
namespace application\models;

class Article extends \core\Model
{
    /**
     * @var string Имя обрабатываемой таблицы 
     */
    public $tableName = 'articles';
    
    /**
     * @var string Критерий сортировки строк таблицы
     */
    public $orderBy = 'publicationDate DESC';
    
    /**
    * @var int ID статей из базы данны
    */
    public $id = null;

    /**
    * @var int Дата первой публикации статьи
    */
    public $publicationDate = null;

    /**
    * @var string Полное название статьи
    */
    public $title = null;

     /**
    * @var int ID категории статьи
    */
    public $categoryId = null;

    /**
    * @var string Краткое описание статьи
    */
    public $summary = null;

    /**
    * @var string HTML содержание статьи
    */
    public $content = null;
            

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
        $sql = "INSERT INTO $this->tableName ( publicationDate, categoryId, title, summary, content ) VALUES ( FROM_UNIXTIME(:publicationDate), :categoryId, :title, :summary, :content )";
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":publicationDate", $this->publicationDate, \PDO::PARAM_INT );
        $st->bindValue( ":categoryId", $this->categoryId, \PDO::PARAM_INT );
        $st->bindValue( ":title", $this->title, \PDO::PARAM_STR );
        $st->bindValue( ":summary", $this->summary, \PDO::PARAM_STR );
        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
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
        $sql = "UPDATE $this->tableName SET publicationDate=FROM_UNIXTIME(:publicationDate), categoryId=:categoryId, title=:title, summary=:summary, content=:content WHERE id = :id";
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":publicationDate", $this->publicationDate, \PDO::PARAM_INT );
        $st->bindValue( ":categoryId", $this->categoryId, \PDO::PARAM_INT );
        $st->bindValue( ":title", $this->title, \PDO::PARAM_STR );
        $st->bindValue( ":summary", $this->summary, \PDO::PARAM_STR );
        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }


    
}

