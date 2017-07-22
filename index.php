<?php


require_once ("autoload.php"); // автозагрузка классов


Config::debugReporting(); // включаем "строгое" отслеживание ошибок E_ALL

\core\Session::get();

$route = Url::getRoute();

\DebugPrinter::debug($route, 'путь, найденный URL--ом, передаваемый в Router');
\DebugPrinter::debug($_SESSION);

$obj = new Router($route);
