<?php


namespace application\models;

/**
 * Пример реализации класса пользователя (реализуем требующие этого методы абстрактные методы)
 *
 */
class ExampleUser extends \ItForFree\SimpleMVC\User {
    
    protected function checkAuthData($login, $pass) {
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
    
}
