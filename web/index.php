<?php
use ItForFree\SimpleMVC\Application;

require_once("autoload.php"); // автозагрузка классов


$Sess = Sess;

//$route = \core\mvc\view\Url::getRoute();
//$obj = new \core\Router($route);


$App = new Application();
$App->run();