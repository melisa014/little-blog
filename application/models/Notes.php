<?php
namespace application\models;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Notes extends BaseExampleModel {
    
    public $tableName = "notes";
    
    public $orderBy = 'publicationDate ASC';
    
    public $id = null;
    
    public $title = null;
    
    public $content = null;
    
    public $publicationDate = null;
    
    
    public function insert()
    {
        $sql = "INSERT INTO $this->tableName (title, content, publicationDate) VALUES (:title, :content, :publicationDate)"; 
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":publicationDate", (new \DateTime('NOW'))->format('Y-m-d H:i:s'), \PDO::PARAM_STMT);
        $st->bindValue( ":title", $this->title, \PDO::PARAM_STR );

        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
        $st->execute();
        $this->id = $this->pdo->lastInsertId();
    }
    
    public function update()
    {
        $sql = "UPDATE $this->tableName SET publicationDate=:publicationDate, title=:title, content=:content WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );
        
        $st->bindValue( ":publicationDate", (new \DateTime('NOW'))->format('Y-m-d H:i:s'), \PDO::PARAM_STMT);
        $st->bindValue( ":title", $this->title, \PDO::PARAM_STR );

        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }
}

