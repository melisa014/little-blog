<?php

require_once ("autoload.php"); // автозагрузка классов

Config::debugReporting(); // включаем "строгое" отслеживание ошибок E_ALL

echo Config::$db_username; // проверяем, загрузился ли Config

DebugPrinter::debug(Config::$db_username); // проверяем, загрузился ли DebugPrinter


$action = Url::getAction();
$obj = new Router($action);




