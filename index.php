<?php

require_once ("autoload.php"); // автозагрузка классов
require_once ("debugPrinter.php"); // ф-ция debug() для отладки 

Config::debugReporting(); // включаем "строгое" отслеживание ошибок E_ALL

$action = Url::getAction();
$obj = new Router($action);




