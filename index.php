<?php


//require_once ("autoload.php"); // автозагрузка классов
require __DIR__ . '/vendor/autoload.php';


echo('<pre>'); print_r(spl_autoload_functions()); echo('</pre>');

$view = new ItForFree\PhpExamples\MVC\SimpleView();

echo 123;
//Config::debugReporting(); // включаем "строгое" отслеживание ошибок E_ALL
//
//$Sess = \core\Session::get();
//
//$route = Url::getRoute();
////    \DebugPrinter::debug($route, 'путь, найденный URL--ом, передаваемый в Router');
//$obj = new Router($route);
