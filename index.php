<?php

require_once ("autoload.php"); // автозагрузка классов
//\core\DebugPrinter::debug(\core\Session::get());
//\core\DebugPrinter::debug(\core\Config::debugReporting());

\Config::debugReporting(); // включаем "строгое" отслеживание ошибок E_ALL

$Sess = \core\Session::get();

$route = \core\mvc\view\Url::getRoute();
//    \core\DebugPrinter::debug($route, 'путь, найденный URL--ом, передаваемый в Router');
$obj = new \core\Router($route);