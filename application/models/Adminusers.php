<?php

namespace application\models;

/**
 * Description of AuthUsers
 *
 * @author qwe
 */
class Adminusers extends \core\mvc\Model
{
    /**
     * Имя таблицы пользователей
     */
    public $tableName = 'users';
    
    /**
     * @var string Критерий сортировки строк таблицы
     */
    public $orderBy = 'timestamp DESC';
    
    /**
     * Логин пользователя
     * @var type 
     */
    public $login = null;
    
    /**
     * Логин пользователя
     * @var type 
     */
    public $salt = null;
    /**
     * @var type 
     */
    public $pass = null;
    
    /**
     * @var type 
     */
    public $email = null;
    
    /**
     * @var type 
     */
    public $id = null;
    
    /**
     * @var type 
     */
    public $timestamp = null;
    
    /**
     * @var type 
     */
    public $role = null;
    
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
     * Добавляем нового пользователя
     */
    public function insert()
    {
        
        $sql = "INSERT INTO $this->tableName (timestamp, login, salt, pass, role, email) VALUES (:timestamp, :login, :salt, :pass, :role, :email)"; 
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":timestamp", (new \DateTime('NOW'))->format('Y-m-d H:i:s'), \PDO::PARAM_STMT);
        $st->bindValue( ":login", $this->login, \PDO::PARAM_STR );
        
        //Хеширование пароля
        $this->salt = rand(0,1000000);
        $st->bindValue( ":salt", $this->salt, \PDO::PARAM_STR );
//        \DebugPrinter::debug($this->salt);
        
        $this->pass .= $this->salt;
        $hashPass = password_hash($this->pass, PASSWORD_BCRYPT);
//        \DebugPrinter::debug($hashPass);
        $st->bindValue( ":pass", $hashPass, \PDO::PARAM_STR );
        
        $st->bindValue( ":role", $this->role, \PDO::PARAM_STR );
        $st->bindValue( ":email", $this->email, \PDO::PARAM_STR );
        $st->execute();
        $this->id = $this->pdo->lastInsertId();
    }

    /**
    * Обновляем текущий объект статьи в базе данных
    */
    public function update()
    {
        $sql = "UPDATE $this->tableName SET timestamp=:timestamp, login=:login, pass=:pass, role=:role, email=:email  WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":timestamp", (new \DateTime('NOW'))->format('Y-m-d H:i:s'), \PDO::PARAM_STMT);
        $st->bindValue( ":login", $this->login, \PDO::PARAM_STR );
        
        // Хеширование пароля
        $this->salt = rand(0,1000000);
        $st->bindValue( ":salt", $this->salt, \PDO::PARAM_STR );
        $this->pass .= $this->salt;
        $hashPass = password_hash($this->pass, PASSWORD_BCRYPT);
        $st->bindValue( ":pass", $hashPass, \PDO::PARAM_STR );
        
        $st->bindValue( ":role", $this->role, \PDO::PARAM_STR );
        $st->bindValue( ":email", $this->email, \PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }
    
}
