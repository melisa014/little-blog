<?php

require_once ("autoload.php"); // автозагрузка классов

Config::debugReporting(); // включаем "строгое" отслеживание ошибок E_ALL

//$obj = new PDO(Config::$db_dsn, Config::$db_username, Config::$db_password);
//\DebugPrinter::debug($obj);

//$conn = new \core\Model();

//\DebugPrinter::debug($conn->pdo);

$action = Url::getAction();
$obj = new Router($action);




