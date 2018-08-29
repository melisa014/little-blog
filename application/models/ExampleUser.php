<?php


namespace application\models;

/**
 * Пример реализации класса пользователя (реализуем требующие этого методы абстрактные методы)
 * Эту модель наследуем от специального класа-модели User из ядра SimpleMVC
 *
 */
class ExampleUser extends \ItForFree\SimpleMVC\User 
{

    protected function checkAuthData($login, $pass) 
    {
        $result = false;
        
        $pdo = new mvc\Model();
        $sql = "SELECT salt, pass FROM users WHERE login = :login";
        $st = $pdo->pdo->prepare($sql);
        $st->bindValue( ":login", $login, \PDO::PARAM_STR);
        $st->execute();
        $siteAuthData = $st->fetch();
   
        $pass .= $siteAuthData['salt'];
        $passForCheck = password_verify($pass, $siteAuthData['pass']);

        
        if (isset($siteAuthData['pass'])) {
            if ($passForCheck) {
                $result = true;
            }
        }
        return $result;
        
    }
    
    /**
     * Вернёт id пользователя
     * 
     * @return int
     */
    public function getId()
    {
        if ($this->userName !== 'guest'){
            $sql = "SELECT id FROM users where login = :userName";
            $st = $this->pdo->prepare($sql); 
            $st -> bindValue( ":userName", $this->userName, \PDO::PARAM_STR );
            $st -> execute();
            $row = $st->fetch();
            return $row['id']; 
        } else  {
            return null;
        }  
    }
    
}
