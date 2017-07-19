<?php

session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

if ( $action != "login" && $action != "logout" && !$username ) {
    login();
    exit;
}
/**
 * Класс, содержащий настройки доступа пользователя 
 */

class User 
{
    
    
    
    
}

