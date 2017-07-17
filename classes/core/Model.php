<?php

namespace core;
/**
 * Модель -- используя конфиг, как минимум подключается к базе данных и даёт 
 * потомкам работать с соединением
 */
class Model 
{
   public $pdo;
   
   public $tableName = '';

   /**
    * Устанавливает соединение с БД
    * 
    * @return объект класса PDO для раборы с БД
    */
   public function __construct() 
   {
       $this->pdo = new \PDO(\Config::$db_dsn, \Config::$db_username,
               \Config::$db_password,
               array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
       return $this->pdo;
   }
   
   public function prepare($sql) 
   {
       return $this->pdo->prepare($sql);   
       
   }
   
    /**
     * Одна статья = одна строка таблицы
     * Возвращает объект класса модели
     * 
     * @param int $id
     * @return obgect
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM $this->tableName where id = :id";
//        \DebugPrinter::debug(self::$pdo);
//      
        $modelClassName = static::class;
        
        $st = $this->prepare($sql);
//        \DebugPrinter::debug($st);
        
        $st -> bindValue( ":id", $id, \PDO::PARAM_INT );
        $st -> execute();
        $row = $st->fetch();
//        echo $modelClassName;
        if ( $row ) { return new $modelClassName( $row );}
    }
   
    /**
    * Возвращает все (или диапазон) объекты Article из базы данных
    *
    * @param int Optional Количество возвращаемых строк (по умолчанию = all)
    * @param int Optional Вернуть статьи только из категории с указанным ID
    * @param string Optional Столбц, по которому выполняется сортировка статей (по умолчанию = "publicationDate DESC")
    * @return Array|false Двух элементный массив: results => массив объектов Article; totalRows => общее количество строк
    */

//            public static function getList( $numRows=1000000, $categoryId=null, $order="publicationDate DESC" ) {
//                $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
//                $categoryClause = $categoryId ? "WHERE categoryId = :categoryId" : "";
//                $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) AS publicationDate
//                        FROM articles $categoryClause
//                        ORDER BY " . $conn->query($order) . " LIMIT :numRows";

    public static function getList( $numRows=1000000, $categoryId=null, $order="publicationDate DESC" ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $categoryClause = $categoryId ? "WHERE categoryId = :categoryId" : "";
        $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) AS publicationDate
                FROM articles $categoryClause
                ORDER BY  $order  LIMIT :numRows";

        $st = $conn->prepare( $sql );
//                        echo "<pre>";
//                        print_r($st);
//                        echo "</pre>";
//                        Здесь $st - текст предполагаемого SQL-запроса, причём переменные не отображаются
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        if ( $categoryId ) $st->bindValue( ":categoryId", $categoryId, PDO::PARAM_INT );
        $st->execute();
//                        echo "<pre>";
//                        print_r($st);
//                        echo "</pre>";
//                        Здесь $st - текст предполагаемого SQL-запроса, причём переменные не отображаются
        $list = array();

        while ( $row = $st->fetch() ) {
            $article = new Article( $row );
            $list[] = $article;
        }

        // Получаем общее количество статей, которые соответствуют критерию
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

    
     public function storeFormValues ( $params ) {

        // Сохраняем все параметры
        $this->__construct( $params );

        // Разбираем и сохраняем дату публикации
        if ( isset($params['publicationDate']) ) {
            $publicationDate = explode ( '-', $params['publicationDate'] );

            if ( count($publicationDate) == 3 ) {
                list ( $y, $m, $d ) = $publicationDate;
                $this->publicationDate = mktime ( 0, 0, 0, $m, $d, $y );
            }
        }
    }
}

