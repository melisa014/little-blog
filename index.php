<?php
use ItForFree\SimpleMVC\Application;

require_once ("autoload.php"); // автозагрузка классов

\Config::debugReporting(); // включаем "строгое" отслеживание ошибок E_ALL

$Sess = \core\Session::get();

$App = new Application;
$App->run();

