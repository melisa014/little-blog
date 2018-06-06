<?php
use ItForFree\SimpleMVC\Application;

require_once("autoload.php"); // автозагрузка классов

\Config::debugReporting(); // включаем "строгое" отслеживание ошибок E_ALL

$Sess = \core\Session::get();

//$route = \core\mvc\view\Url::getRoute();
//$obj = new \core\Router($route);


$App = new Application;
$App->run();